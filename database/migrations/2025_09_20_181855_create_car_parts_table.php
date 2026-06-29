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
            $table->foreignId('car_brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('car_model_id')->nullable()->constrained('car_models')->onDelete('set null');
            $table->foreignId('part_type_id')->nullable()->constrained('car_part_types')->onDelete('set null');
            $table->foreignId('part_brand_id')->nullable()->constrained('sub_categories')->onDelete('set null');

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('part_number');
            $table->string('vin_code')->nullable();

            $table->boolean('fav_product')->nullable();

            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->enum('stock_type', ['in', 'out'])->default('in');
            $table->integer('stock_quantity')->default(0);

            $table->string('feature_image')->nullable();
            $table->json('gallery_images')->nullable();

            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
