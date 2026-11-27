<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('order_item_addons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_item_id')->constrained('order_items')->cascadeOnDelete();
        $table->foreignId('addon_id')->constrained('addons');
        $table->unsignedInteger('price');
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('order_item_addons'); }
};
