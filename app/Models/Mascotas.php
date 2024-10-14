<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=['id_tipo','raza','nombre','cuidados','fecha_nacimiento','precio','foto'];

}
