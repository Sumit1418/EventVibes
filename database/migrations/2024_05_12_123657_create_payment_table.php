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
        Schema::create('payment', function (Blueprint $table) {
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('company_id');
            $table->date('date')->default(now()->toDateString());
            $table->decimal('amount', 20, 2);
            $table->enum('status', ['completed', 'pending'])->default('pending');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
