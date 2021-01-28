<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brigade extends Model
{
    use HasFactory;

    protected $table = 'brigade';
    protected $primaryKey ='idBrigade';
    public $timestamps = false;



    

}
