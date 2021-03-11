<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('route', function (Blueprint $table) {
            //
            $table->bigInteger('idBrigade')->nullable()->unsigned();
            $table->foreign('idBrigade')->references('idBrigade')->on('brigade')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route', function (Blueprint $table) {
            //
            });
    }
} 
