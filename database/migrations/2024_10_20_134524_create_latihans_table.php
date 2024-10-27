<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latihans', function (Blueprint $table) {
            $table->id();
            $table->string('anggota_id');
            $table->string('jenis_id');
            $table->date('tanggal');
            $table->string('durasi');
            $table->timestamps();

            // Create a composite unique index for anggota_id, jenis_id, and tanggal
            $table->unique(['anggota_id', 'jenis_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('latihans');
    }
}
