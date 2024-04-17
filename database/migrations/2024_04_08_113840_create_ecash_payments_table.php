<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ecash_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('amount');
            $table->string('verification_code', length: 32)->nullable();
            $table->string('checkout_type', length: 10);
            $table->string('currency');
            $table->string('status')->default('pending');
            $table->string('transaction_no')->nullable();
            $table->string('message')->nullable();
            $table->string('checkout_url', 1000)->nullable();
            $table->timestamps();
        });
    }
};
