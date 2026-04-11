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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description');
            $table->float('price');
            $table->integer('discount')->nullable()->default('0');
            $table->float('discount_price')->nullable()->default('0');
            $table->integer('stock');
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('view_count')->default('0');
            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* drop foreign key */
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
        });

        Schema::dropIfExists('products');
    }
};
