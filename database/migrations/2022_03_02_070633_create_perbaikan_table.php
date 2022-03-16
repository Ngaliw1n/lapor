<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->bigIncrements('id_perbaikan');
            $table->string('nm_perbaikan');        
            $table->date('tgl')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('gmbr_perbaikan');
            $table->string('detail');
            
            $table->unsignedBigInteger('id_mesins');
            $table->foreign('id_mesins')->references('id_mesin')->on('mesins')->onDelete('cascade');
            $table->unsignedBigInteger('id_outlets');
            $table->foreign('id_outlets')->references('outlets_id')->on('outlets')->onDelete('cascade');
            $table->unsignedBigInteger('id_pelapor');
            $table->foreign('id_pelapor')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_kerusakan');
            $table->foreign('id_kerusakan')->references('id_kerusakan')->on('kerusakan')->onDelete('cascade');
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
        Schema::dropIfExists('perbaikan');
    }
}
