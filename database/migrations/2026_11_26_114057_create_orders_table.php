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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_no')->unique();
        $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        $table->string('customer_name')->nullable(); // untuk pesanan walk-in
        $table->string('order_type')->default('pickup'); // pickup | dine_in
        $table->string('table_no', 10)->nullable();
        $table->string('status')->default('menunggu_pembayaran');
        // menunggu_pembayaran | diproses | siap | selesai | dibatalkan
        $table->unsignedInteger('total')->default(0);
        $table->text('notes')->nullable();
        $table->timestamp('ordered_at')->useCurrent();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('orders'); }
};
