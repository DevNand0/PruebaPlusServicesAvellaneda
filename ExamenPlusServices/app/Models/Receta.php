<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "receta";
    protected $fillable = [ 'medicacion',
                            'paciente_id',
                            'dieta'
                          ];
    public $timestamps = false;
}
