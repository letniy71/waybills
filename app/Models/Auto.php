<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    protected $table = 'auto';
    protected $primaryKey ='idauto';
    public $timestamps = false;

    public function brigade()
    {
        return $this->belongsTo('\App\Models\Brigade','idBrigade','idBrigade');
    }
    

}
