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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null');

            $table->string('order_number')->unique();
            $table->string('order_notes')->nullable();
            $table->string('payment_method')->nullable(); // e.g., 'COD', 'card payment'
            $table->string('status')->default('review'); // e.g. 'pending', 'processing', 'complete', 'cancel'

            $table->string('first_name');
            $table->string('last_name');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('USA');
            $table->string('order_address_default'); // home, office, school, etc.

            $table->string('total');
            $table->json('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
