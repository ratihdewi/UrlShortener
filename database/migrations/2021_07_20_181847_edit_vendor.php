<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('no')->nullable()->change();
            $table->string('no_rek')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('bank_name')->nullable()->change();
            $table->string('no_telp')->nullable()->change();
            $table->string('no_tax')->nullable()->change();
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
