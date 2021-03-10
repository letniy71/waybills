<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Waybills extends Model
{
    use HasFactory;

    protected $table = 'waybills';
    protected $primaryKey ='idWaybills';
    public $timestamps = false;

    public function brigade()
    {
        return $this->belongsTo('\App\Models\Brigade','idBrigade','idBrigade');
    }


    public function drivers()
    {
        return $this->belongsTo('\App\Models\Drivers','idDrivers','idDrivers');
    }


    public function 	organization()
    {
        return $this->belongsTo('\App\Models\Organization','	idorganization','	idorganization');
    }


    public function auto()
    {
        return $this->belongsTo('\App\Models\Auto','idAuto','idAuto');
    }

    public function dispatchers()
    {
        return $this->belongsTo('\App\Models\Dispatchers','idDispatcher','idDispatcher');
    }



    public function mechanics()
    {
        return $this->belongsTo('\App\Models\Mechanics','idMechanics','idMechanics');
    }


    public function route()
    {
        return $this->belongsTo('\App\Models\Route','idroute','idroute');
    }

    public function address()
    {
        return $this->belongsTo('\App\Models\Address','idAddress','idAddress');
    }

    public function typeWB()
    {
        return $this->belongsTo('\App\Models\TypeWB','idtypeWB','idtypeWB');
    }

}
