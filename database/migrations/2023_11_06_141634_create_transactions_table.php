<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel Customer
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 50);
            $table->timestamps();
        });

        // Tabel Customer Address
        Schema::create('customer_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->date('address');
            $table->timestamps();
            
            $table->foreign('customer_id')->references('id')->on('customer');
        });

        // Tabel Product
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        // Tabel Payment Method
        Schema::create('payment_method', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        // Tabel Payment Method
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_method');
        Schema::dropIfExists('product');
        Schema::dropIfExists('customer_address');
        Schema::dropIfExists('customer');
        Schema::dropIfExists('transactions');
    }
};


