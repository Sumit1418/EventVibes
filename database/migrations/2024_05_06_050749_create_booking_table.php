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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('booking_id');
            $table->timestamp('booking_date')->useCurrent();
            $table->date('starting_date');
            $table->date('ending_date');
            $table->enum('status', ['upcoming', 'completed', 'cancelled'])->default('upcoming');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('company_id');
            
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
