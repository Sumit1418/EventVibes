<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToCompanydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companydetails', function (Blueprint $table) {
            $table->enum('status', ['approved', 'disapproved'])->default('disapproved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companydetails', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
