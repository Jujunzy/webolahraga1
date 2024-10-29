<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemenangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemenangs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('anggota')->constrained('anggotas');
            $table->string('event_id');
            $table->string('anggota_id');
            $table->string('posisi');
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
        Schema::dropIfExists('pemenangs');
    }
}
