<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID or string identifier for tenant
            $table->string('name'); // Add this line for tenant name
            $table->string('subdomain')->unique(); // Tenant's unique subdomain
            $table->string('plan')->default('free'); // subscription plan (free, pro, etc.)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // approval status
            $table->timestamp('expires_at')->nullable();             // Expiration date
            $table->string('admin_email')->nullable(); // Add this line for admin email
            
            $table->timestamps();

            // Optional json for extra data or settings
            $table->json('data')->nullable();
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
