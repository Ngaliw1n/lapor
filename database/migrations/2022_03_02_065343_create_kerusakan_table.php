<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerusakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->bigIncrements('id_kerusakan');
            $table->string('nm_kerusakan');        
            $table->date('tgl')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('gmbr_kerusakan');
            $table->string('detail');
            
            $table->unsignedBigInteger('id_mesins');
            $table->foreign('id_mesins')->references('id_mesin')->on('mesins')->onDelete('cascade');
            $table->unsignedBigInteger('id_outlets');
            $table->foreign('id_outlets')->references('id')->on('outlets')->onDelete('cascade');
            $table->unsignedBigInteger('id_pelapor');
            $table->foreign('id_pelapor')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('kerusakan');
    }
}
