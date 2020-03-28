<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openclients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name',200)->nullable();
            $table->string('finance_name',200)->nullable();
            $table->string('finance_email',200)->nullable();
            $table->string('finance_contact_number',200)->nullable();
            $table->string('address',200)->nullable();
            $table->string('tan',200)->nullable();
            $table->string('pan',200)->nullable();
            $table->string('gst',200)->nullable();
            $table->string('is_deleted',200)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('openclients');
    }
}
