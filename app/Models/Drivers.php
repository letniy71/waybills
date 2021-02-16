<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;
    protected $table = 'drivers';
    protected $primaryKey ='idDrivers';
    public $timestamps = false;

    public function brigade()
    {
        return $this->belongsTo('\App\Models\Brigade','idBrigade','idBrigade');
    }
}
 