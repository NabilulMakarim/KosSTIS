<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit__kamars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('harga');
            $table->string('kamarMandi');
            $table->text('fasilitas');
            $table->string('image');
            $table->text('deskripsi');
            $table->text('ringkasan');
            $table->integer('durSewa');
            $table->integer('user_id');
            $table->integer('kamar_id');
            $table->integer('jumKam');
            $table->integer('jumKos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edit__kamars');
    }
}
