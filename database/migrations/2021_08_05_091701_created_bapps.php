<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedBapps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bapps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('procurement_id');
            $table->datetime('date');
            $table->string('no_surat');
            $table->string('name_to');
            $table->string('memo_related');
            $table->string('closing');
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
