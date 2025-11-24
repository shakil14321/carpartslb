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
        Schema::create('site_setting', function (Blueprint $table) {
            $table->id();
            $table->string('site_logo')->nullable();
            $table->string('carousel_image_one')->nullable();
            $table->string('carousel_image_two')->nullable();
            $table->string('carousel_image_three')->nullable();
            $table->text('notice_bar')->nullable();
            $table->json('menu_items')->nullable();
            $table->string('brand_quantity')->nullable();
            $table->string('google_verification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_setting');
    }
};
