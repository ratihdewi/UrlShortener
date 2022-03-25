<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaNegosiasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_negosiasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('spph_id');
            $table->integer('procurement_id');
            $table->datetime('date');
            $table->string('time');
            $table->string('location');
            $table->string('meeting_result');
            $table->string('photo_doc');
            $table->double('negosiasi')->nullable();
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
        //
    }
}
