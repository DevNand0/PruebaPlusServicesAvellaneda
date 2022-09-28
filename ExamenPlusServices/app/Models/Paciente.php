<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Paciente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "paciente";
    protected $fillable = [ 'nombre_completo',
                            'cedula',
                            'email',
                            'fecha_nacimiento',
                            'celular'
                          ];
    public $timestamps = true;


}
