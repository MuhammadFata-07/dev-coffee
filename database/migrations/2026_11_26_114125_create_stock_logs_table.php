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
    Schema::create('stock_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
        $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        $table->integer('change_qty'); // negatif = berkurang
        $table->string('reason'); // pesanan | pembatalan | penyesuaian
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('stock_logs'); }
};
