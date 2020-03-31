<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_perusahaan');
            $table->text('deskripsi');
            $table->text('job_requirement');
            $table->text('job_desc');
            $table->text('alamat');
            $table->string('file');
            $table->dateTime('deadline');
            $table->string('file_pengumuman')->nullable();
            $table->boolean('aktif')->default(true);
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
        Schema::dropIfExists('perusahaans');
    }
}
