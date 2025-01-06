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
        Schema::create('companydetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('owner_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->enum('type', ['caterer', 'decorator', 'photographer', 'musician', 'lighting', 'dj', 'eventplanner'])->nullable();
            $table->string('budget')->nullable();
            $table->string('serviceable_states')->nullable();
            $table->string('serviceable_pincodes')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companydetails');
    }
};
