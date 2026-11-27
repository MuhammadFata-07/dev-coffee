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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
        $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
        $table->string('method'); // tunai | qris | transfer
        $table->unsignedInteger('amount');
        $table->string('proof_image')->nullable();
        $table->string('status')->default('menunggu'); // menunggu | lunas | ditolak
        $table->timestamp('paid_at')->nullable();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('payments'); }
};
