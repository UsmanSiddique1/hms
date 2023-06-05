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
        Schema::create('slip_procedures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('slip_id')->unsigned();
            $table->bigInteger('procedure_id')->unsigned();
            $table->bigInteger('price')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('slip_id')->references('id')->on('slips')->onDelete('cascade');
            $table->foreign('procedure_id')->references('id')->on('procedures')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slip_procedures');
    }
};
