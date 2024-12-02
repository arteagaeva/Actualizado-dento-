<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita; // Modelo para la tabla citas
use App\Models\Paciente; // Modelo para la tabla pacientes
use App\Models\Doctor; // Modelo para la tabla doctores

class CitaController extends Controller
{
    /**
     * Muestra el formulario de registro de citas.
     */
    public function create()
    {
        // Opcional: Obtener pacientes y doctores para desplegar en un select (si lo necesitas)
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        return view('citas.citas', compact('pacientes', 'doctores'));
    }

    /**
     * Almacena una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $validated = $request->validate([
            'idPaciente' => 'required|exists:pacientes,idPaciente', // Verifica que el paciente exista
            'idDoctor' => 'required|exists:doctores,idDoctor', // Verifica que el doctor exista
            'idTratamiento' => 'required|integer|min:1', // Validar que sea un entero mayor que 0
            'fechaCita' => 'required|date|after_or_equal:today', // Validar que la fecha sea hoy o posterior
            'estado' => 'required|in:Pendiente,Confirmada,Cancelada', // Opciones válidas para el estado
            'motivo' => 'required|string|max:500', // Motivo de la cita
        ]);

        // Crear una nueva cita
        Cita::create($validated);

        // Redirigir con un mensaje de éxito
        return redirect()->route('citas.create')->with('success', 'Cita registrada exitosamente.');
    }

    /**
     * Muestra todas las citas en una tabla.
     */
    public function index()
{
    $citas = Cita::with(['paciente', 'doctor'])->get(); // Cargar relaciones para detalles
    return view('citas.tablacitas', compact('citas'));
}


    /**
     * Muestra el formulario para editar una cita.
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id); // Buscar la cita por ID
        $pacientes = Paciente::all(); // Opcional: Obtener todos los pacientes para desplegar
        $doctores = Doctor::all(); // Opcional: Obtener todos los doctores para desplegar
        return view('citas.editarCita', compact('cita', 'pacientes', 'doctores'));
    }

    /**
     * Actualiza una cita existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'idPaciente' => 'required|exists:pacientes,idPaciente',
            'idDoctor' => 'required|exists:doctores,idDoctor',
            'idTratamiento' => 'required|integer|min:1',
            'fechaCita' => 'required|date|after_or_equal:today',
            'estado' => 'required|in:Pendiente,Confirmada,Cancelada',
            'motivo' => 'required|string|max:500',
        ]);

        // Buscar y actualizar la cita
        $cita = Cita::findOrFail($id);
        $cita->update($validated);

        // Redirigir con un mensaje de éxito
        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    /**
     * Elimina una cita de la base de datos.
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
