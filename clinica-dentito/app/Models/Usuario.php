<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; // Nombre de la tabla
    protected $primaryKey = 'IdUsuario'; // Llave primaria

    public $timestamps = false; // Si no tienes columnas `created_at` y `updated_at`

    protected $fillable = [
        'Email',
        'Contraseña',
        'Rol', // Si es necesario para permisos o roles
    ];

    /**
     * Método para verificar contraseñas en el sistema.
     */
    public function verifyPassword($inputPassword)
    {
        return password_verify($inputPassword, $this->Contraseña);
    }
}
