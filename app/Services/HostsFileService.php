<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class HostsFileService
{
    private const MARKER_START   = '# === DINEFLOW TENANTS START ===';
    private const MARKER_END     = '# === DINEFLOW TENANTS END ===';
    private const CENTRAL_DOMAIN = 'dineflow.com';

    private string $hostsPath;

    public function __construct()
    {
        $this->hostsPath = PHP_OS_FAMILY === 'Windows'
            ? 'C:\\Windows\\System32\\drivers\\etc\\hosts'
            : '/etc/hosts';
    }

    public function addTenantEntry(string $subdomain, string $tenantName = ''): bool
    {
        try {
            $current = $this->read();
            $block   = $this->parseBlock($current);
            $domain  = $subdomain . '.' . self::CENTRAL_DOMAIN;

            if (str_contains($block, $domain)) {
                Log::info("[HostsFileService] Entry already exists for {$domain}, skipping.");
                return true;
            }

            $comment = $tenantName ? "   # {$tenantName}" : '';
            $block  .= PHP_EOL . "127.0.0.1 {$domain}{$comment}";

            return $this->writeBlock($current, $block);

        } catch (\Throwable $e) {
            Log::warning("[HostsFileService] addTenantEntry failed: " . $e->getMessage());
            return false;
        }
    }

    public function removeTenantEntry(string $subdomain): bool
    {
        try {
            $current = $this->read();
            $block   = $this->parseBlock($current);
            $domain  = $subdomain . '.' . self::CENTRAL_DOMAIN;

            $lines    = explode(PHP_EOL, $block);
            $filtered = array_filter($lines, fn($line) => ! str_contains($line, $domain));

            return $this->writeBlock($current, implode(PHP_EOL, $filtered));

        } catch (\Throwable $e) {
            Log::warning("[HostsFileService] removeTenantEntry failed: " . $e->getMessage());
            return false;
        }
    }

    public function syncAll(array $tenants): bool
    {
        try {
            $current = $this->read();
            $lines   = [];

            foreach ($tenants as $tenant) {
                $domain  = $tenant['subdomain'] . '.' . self::CENTRAL_DOMAIN;
                $comment = isset($tenant['name']) ? "   # {$tenant['name']}" : '';
                $lines[] = "127.0.0.1 {$domain}{$comment}";
            }

            return $this->writeBlock($current, implode(PHP_EOL, $lines));

        } catch (\Throwable $e) {
            Log::warning("[HostsFileService] syncAll failed: " . $e->getMessage());
            return false;
        }
    }

    private function read(): string
    {
        if (! file_exists($this->hostsPath)) {
            throw new \RuntimeException("Hosts file not found: {$this->hostsPath}");
        }

        $content = file_get_contents($this->hostsPath);

        if ($content === false) {
            throw new \RuntimeException("Cannot read hosts file — run PHP/your terminal as Administrator.");
        }

        return $content;
    }

    private function parseBlock(string $hostsContent): string
    {
        $pattern = '/' . preg_quote(self::MARKER_START, '/') . '\r?\n(.*?)\r?\n' . preg_quote(self::MARKER_END, '/') . '/s';

        return preg_match($pattern, $hostsContent, $m) ? trim($m[1]) : '';
    }

    private function writeBlock(string $hostsContent, string $block): bool
    {
        $managed = self::MARKER_START . PHP_EOL
                 . '127.0.0.1 ' . self::CENTRAL_DOMAIN . PHP_EOL
                 . trim($block) . PHP_EOL
                 . self::MARKER_END;

        $pattern = '/' . preg_quote(self::MARKER_START, '/') . '.*?' . preg_quote(self::MARKER_END, '/') . '\r?\n?/s';
        $cleaned = preg_replace($pattern, '', $hostsContent);
        $updated = rtrim($cleaned) . PHP_EOL . PHP_EOL . $managed . PHP_EOL;

        if (file_put_contents($this->hostsPath, $updated) === false) {
            throw new \RuntimeException("Cannot write to hosts file — run PHP/your terminal as Administrator.");
        }

        Log::info("[HostsFileService] Hosts file updated successfully.");
        return true;
    }
}