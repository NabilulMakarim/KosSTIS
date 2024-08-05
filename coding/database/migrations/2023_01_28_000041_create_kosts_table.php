<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama');
            // $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('no');
            $table->string('kelurahan');
            $table->string('noHp');
            $table->string('image')->nullable();
            $table->string('area');
            $table->string('gender');
            $table->integer('harga');
            $table->integer('jumKam'); //jumlah kamar
            $table->integer('jumKos'); //jumlah kamar kosong
            $table->text('fasilitas');
            $table->text('ringkasan');
            $table->text('deskripsi');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->integer('durSewa'); //durasi sewa
            // $table->text('tipe')->nullable(); //tipe kamar kost
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kosts');
    }
}
