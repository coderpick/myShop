<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
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
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('quantity');
            $table->float('total_price');
            $table->string('order_number')->unique();
            $table->enum('payment_method', ['online', 'cod']);
            $table->enum('payment_status', [PaymentStatus::PENDING->value, PaymentStatus::SUCCESSFUL->value, PaymentStatus::PROCESSING->value, PaymentStatus::CANCELED->value, PaymentStatus::FAILED->value])->default(PaymentStatus::PENDING->value);
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', [OrderStatus::PENDING->value, OrderStatus::CONFIRMED->value, OrderStatus::PROCESSING->value, OrderStatus::SHIPPED->value, OrderStatus::OUT_FOR_DELIVERY->value, OrderStatus::DELIVERED->value, OrderStatus::CANCELLED->value])->default(OrderStatus::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop foreign key
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('orders');
    }
};
