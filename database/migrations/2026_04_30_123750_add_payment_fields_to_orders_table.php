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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->unique()->after('id');
            $table->enum('payment_method', ['online', 'cod'])->default('cod')->after('total_price');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->string('transaction_id')->nullable()->after('payment_status');
            $table->string('customer_name')->after('user_id');
            $table->string('customer_email')->after('customer_name');
            $table->string('customer_phone')->after('customer_email');
            $table->text('shipping_address')->after('customer_phone');
            $table->string('city')->after('shipping_address');
            $table->string('state')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('state');
            $table->text('notes')->nullable()->after('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_number',
                'payment_method',
                'payment_status',
                'transaction_id',
                'customer_name',
                'customer_email',
                'customer_phone',
                'shipping_address',
                'city',
                'state',
                'postal_code',
                'notes',
            ]);
        });
    }
};
