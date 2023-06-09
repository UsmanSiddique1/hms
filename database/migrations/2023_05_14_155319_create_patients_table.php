<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('mr_number')->unique();
            $table->bigInteger('cnic')->unique()->nullable();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->integer('age_years')->nullable();
            $table->integer('age_months')->nullable();
            $table->integer('age_weeks')->nullable();
            $table->bigInteger('phone');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_details');
    }
};
