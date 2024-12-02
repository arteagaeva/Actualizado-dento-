<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Definir la clave primaria si no es "id"
    protected $primaryKey = 'idPaciente';
    
    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombreCompleto', 
        'dni', 
        'email', 
        'telefono', 
        'fechaNacimiento', 
        'direccion', 
        'genero'
    ];
}