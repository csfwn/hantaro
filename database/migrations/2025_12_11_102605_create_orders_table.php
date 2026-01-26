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
            // Remove user_id
            //$table->unsignedBigInteger('user_id'); 
            
            $table->string('ref_no')->unique();
            $table->string('currency_code', 3)->default('MYR');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('delivery_fee', 15, 2)->default(0);
            $table->decimal('service_fee', 15, 2)->default(0);
            $table->string('payment_method')->nullable(); // cash or qr
            $table->timestamp('completed_at')->nullable();
            $table->smallInteger('status')->nullable();
            $table->string('customer_name')->nullable(); // optional, store guest info
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
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
