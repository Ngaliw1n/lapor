<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->bigIncrements('id_spareparts');
            $table->string('nm_spareparts');        
            $table->string('gmbr_spareparts');
            $table->string('kategori');
            $table->string('spareparts_detail');
            
            $table->unsignedBigInteger('id_mesins');
            $table->foreign('id_mesins')->references('id_mesin')->on('mesins')->onDelete('cascade');
            $table->unsignedBigInteger('id_outlets');
            $table->foreign('id_outlets')->references('outlets_id')->on('outlets')->onDelete('cascade');
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
        Schema::dropIfExists('spareparts');
    }
}
