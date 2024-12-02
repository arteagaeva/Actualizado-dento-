<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'doctores';

    // Clave primaria
    protected $primaryKey = 'idDoctor';

    // Indicamos que no usa las columnas de tiempo predeterminadas
    public $timestamps = false;

    // Campos asignables en la base de datos
    protected $fillable = [
        'dniDoctor',
        'nombreCompleto',
        'especialidad',
        'telefono',
        'email',
        'direccion',
        'fechaNacimiento',
        'genero',
    ];

    // Opcional: si los valores se tratan como fechas
    protected $dates = ['fechaNacimiento'];

    // Opcional: si necesitas transformar datos automáticamente
    protected $casts = [
        'genero' => 'string',
    ];
}
