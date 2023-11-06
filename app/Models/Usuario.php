<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   

    protected $table='usuario';
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}
