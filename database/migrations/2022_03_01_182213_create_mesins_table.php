<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
         Schema::create('mesins', function (Blueprint $table) {
            $table->bigIncrements('id_mesin');
            $table->string('nm_mesin');
            $table->string('gbr_mesin');            
            $table->unsignedBigInteger('id_outlet');
            $table->foreign('id_outlet')->references('id')->on('outlets')->onDelete('cascade');
            $table->date('tgl')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('mesins');
    }
}
