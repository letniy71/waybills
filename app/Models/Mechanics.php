<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanics extends Model
{
    use HasFactory;
    protected $table = 'mechanics';
    protected $primaryKey ='idMechanics';
    public $timestamps = false;

    public function brigade()
    {
        return $this->belongsTo('\App\Models\Brigade','idBrigade','idBrigade');
    }
}
