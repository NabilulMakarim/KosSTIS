<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditKostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit__kosts', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->string('kontrakan_id');
            $table->string('nama');
            // $table->text('alamat');
            // $table->string('rt');
            // $table->string('rw');
            // $table->string('no');
            // $table->string('kelurahan');
            $table->string('noHp');
            $table->string('image')->nullable();
            // $table->string('area');
            // $table->string('gender');
            $table->integer('harga');
            // $table->integer('jumKam');
            // $table->integer('jumKos');
            $table->text('fasilitas');
            $table->text('ringkasan');
            $table->text('deskripsi');
            // $table->string('listrik');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            // $table->integer('durSewa');
            // $table->integer('status')->default(1);
            $table->string('longitude');
            $table->string('latitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edit__kosts');
    }
}
