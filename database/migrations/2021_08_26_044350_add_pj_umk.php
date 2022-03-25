<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPjUmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_umk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('procurement_id');
            $table->string('no_memo_umk');
            $table->string('name');
            $table->string('no_pekerja');
            $table->string('jabatan');
            $table->string('fungsi');
            $table->string('gl_account');
            $table->string('cost_center');
            $table->double('total');
            $table->string('invoice_file');
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
