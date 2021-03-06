<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'route';
    protected $primaryKey ='idRoute';
    public $timestamps = false;

    public function brigade()
    {
        return $this->belongsTo('\App\Models\Brigade','idBrigade','idBrigade');
    }
}
 