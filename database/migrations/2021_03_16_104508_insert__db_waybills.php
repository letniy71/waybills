<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDbWaybills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('role')->insert(
        array(
            'name' => 'admin',
            'idRole' => 1)
        );

        DB::table('role')->insert(
        array(
            'name' => 'user',
            'idRole' => 2)
        );

        DB::table('typeWB')->insert(
        array(
            'type' => 'с 6.10',
            'idtypeWB' => 1)
        );

        DB::table('typeWB')->insert(
        array(
            'type' => 'с 18.10',
            'idtypeWB' => 2)
        );


        DB::table('organization')->insert(
        array(
            'nameOrganization' => 0,
            'idorganization'=> 1,
            'active' => 0)
        );

        DB::table('brigade')->insert(
        array(
            'nameBrigade' => 0,
            'idBrigade' => 1,
            'idorganization'=> 1,
            'active' => 0)
        );

        DB::table('users')->insert(
        array(
            'name' => 'admin',
            'email'=> 'letniy71@gmail.com',
            'password' => '$2y$10$7tk5S4SI.H8mJcR2Llgkke57moNyZq3IRJ.c6tcCsBNm/tgrMUsYW',
            'idRole' => 1,
            'idBrigade' => 1,
            'login'=>'admin',
            'active'=>1)
        );


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
