<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name'); $table->string('customer_phone'); $table->text('customer_address');
            $table->decimal('total_amount',12,2); $table->enum('payment_method',['transfer','qris','cod']);
            $table->enum('payment_status',['pending','paid','failed'])->default('pending');
            $table->enum('status',['pending','processing','shipped','completed','cancelled'])->default('pending');
            $table->text('notes')->nullable(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
