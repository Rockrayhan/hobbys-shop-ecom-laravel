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
            $table->string('user_name');
            $table->string('phone');
            $table->text('address');
            $table->boolean('is_inside_dhaka')->default(true);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->decimal('subtotal', 12, 2)->default(0); // sum of order_items.total_price
            $table->decimal('grand_total', 12, 2)->default(0); // subtotal + delivery

            $table->string('order_status')->default('pending'); // pending/processing/completed/cancelled

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
