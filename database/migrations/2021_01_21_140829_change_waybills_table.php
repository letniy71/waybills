<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('waybills', function (Blueprint $table) {
            //
            $table->foreign('idDrivers')->references('idDrivers')->on('drivers')->onUpdate('cascade')->onDelete('set null');
 $table->foreign('idorganization')->references('idorganization')->on('organization')->onUpdate('cascade')->onDelete('set null');
$table->foreign('idAuto')->references('idAuto')->on('auto')->onUpdate('cascade')->onDelete('set null');
$table->foreign('idDispatcher')->references('idDispatcher')->on('dispatchers')->onUpdate('cascade')->onDelete('set null');
 $table->foreign('idMechanics')->references('idMechanics')->on('mechanics')->onUpdate('cascade')->onDelete('set null');
$table->foreign('idtypeWB')->references('idtypeWB')->on('typeWB')->onUpdate('cascade')->onDelete('set null');
$table->foreign('idroute')->references('idroute')->on('route')->onUpdate('cascade')->onDelete('set null');
$table->foreign('idAddress')->references('idAddress')->on('address')->onUpdate('cascade')->onDelete('set null');
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
        Schema::table('waybills', function (Blueprint $table) {
            //
        });
    }
}
