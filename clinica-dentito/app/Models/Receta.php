<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receta extends Model
{
    use HasFactory;

    protected $table = 'recetas'; // Nombre de la tabla

    protected $primaryKey = 'idReceta'; // Clave primaria personalizada

    protected $fillable = [
        'dniPaciente', // Cambiado a dniPaciente
        'dosis',
        'instrucciones',
    ];

    public $timestamps = false;

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'dniPaciente', 'dni'); // Cambiado a dniPaciente
    }
}
