<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waybills', function (Blueprint $table) {
            
            $table->id('idWaybills');
            $table->string('date', 12);
            $table->string('serialWay', 24);
            $table->string('numberWay', 24);
            $table->string('mileageWB_before', 255);
            $table->string('mileageWB_after', 255);
            $table->string('department', 45);
            $table->string('month', 24);

            $table->bigInteger('idDrivers')->nullable()->unsigned();
           

            $table->bigInteger('idorganization')->nullable()->unsigned();
            

            $table->bigInteger('idAuto')->nullable()->unsigned();
            

            $table->bigInteger('idDispatcher')->nullable()->unsigned();
            

            $table->bigInteger('idMechanics')->nullable()->unsigned();
           

            $table->bigInteger('idtypeWB')->nullable()->unsigned();
            

            $table->bigInteger('idroute')->nullable()->unsigned();
            

            $table->bigInteger('idAddress')->nullable()->unsigned();
            

            $table->bigInteger('idBrigade')->nullable()->unsigned();
           

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
        Schema::dropIfExists('waybills');
    }
}

