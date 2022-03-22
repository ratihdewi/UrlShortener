<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditagainInBapps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bapps', function (Blueprint $table) {
            $table->integer('dari');
            $table->integer('kepada');
            $table->dropColumn('name_to');
            $table->longtext('closing')->nullable()->change();
            $table->string('memo_related')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bapps', function (Blueprint $table) {
            //
        });
    }
}
