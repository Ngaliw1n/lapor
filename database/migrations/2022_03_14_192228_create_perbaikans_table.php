<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
         Schema::create('perbaikans', function (Blueprint $table) {
            $table->bigIncrements('id_perbaikan');
            $table->string('nm_perbaikan');
            $table->string('gbr_perbaikan');            
            $table->unsignedBigInteger('id_outlet');
            $table->foreign('id_outlet')->references('outlets_id')->on('outlets')->onDelete('cascade');
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
        Schema::dropIfExists('perbaikans');
    }
}
