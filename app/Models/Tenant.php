<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Facades\DB;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'subdomain',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'subdomain',
            'status',
        ];
    }

    protected static function booted()
    {
        static::deleting(function ($tenant) {
            // Only attempt database deletion if tenant was approved
            if ($tenant->status === 'approved') {
                try {
                    $database = 'tenant_' . $tenant->id;
                    // Check if database exists before attempting to delete
                    $exists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$database]);
                    
                    if (!empty($exists)) {
                        DB::statement("DROP DATABASE `{$database}`");
                    }
                } catch (\Exception $e) {
                    \Log::warning("Could not delete tenant database: {$e->getMessage()}");
                }
            }

            // Delete associated domains
            $tenant->domains()->delete();
        });
    }
}