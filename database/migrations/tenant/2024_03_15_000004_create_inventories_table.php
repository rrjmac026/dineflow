<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->unique();
            $table->integer('quantity')->default(0);
            $table->string('supplier');
            $table->decimal('unit_cost', 10, 2)->nullable();
            $table->integer('reorder_level')->default(10);
            $table->timestamps();
            $table->index(['item_name', 'supplier']); // Add index for frequently searched columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
