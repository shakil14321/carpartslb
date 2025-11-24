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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('user_image')->nullable();
            $table->integer('product_id');
            $table->string('product_title')->nullable();
            $table->string('product_url')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->text('review');
            $table->text('reply')->nullable();
            $table->text('reply_admin_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
