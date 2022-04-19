<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcurementItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('procurement_id');
            $table->string('name');
            $table->double('price_est');
            $table->integer('total_unit');
            $table->string('satuan');
            $table->string('specs');
            $table->integer('vendor_id');
            $table->integer('category_id');
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
        Schema::dropIfExists('procurement_items');
    }
}
