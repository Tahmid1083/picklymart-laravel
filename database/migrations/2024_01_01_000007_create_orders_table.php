<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();          // e.g. PLM-240915-0001
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->text('notes')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->string('payment_method')->default('cash_on_delivery');
            $table->string('status')->default('pending'); // pending | processing | shipped | delivered | cancelled
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
