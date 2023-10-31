<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partida;
class Mano extends Model
{
    use HasFactory;
    protected $table='mano';
    public $timestamps=false;
    
}
