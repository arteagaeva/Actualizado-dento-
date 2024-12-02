<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $primaryKey = 'idCita';

    protected $fillable = [
        'idPaciente',
        'idDoctor',
        'idTratamiento',
        'fechaCita',
        'estado',
        'motivo',
    ];

    public $timestamps = false;
    public function paciente()
{
    return $this->belongsTo(Paciente::class, 'idPaciente', 'idPaciente');
}

public function doctor()
{
    return $this->belongsTo(Doctor::class, 'idDoctor', 'idDoctor');
}
}
