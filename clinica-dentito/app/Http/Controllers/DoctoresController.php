<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctoresController extends Controller
{
    /**
     * Muestra el formulario para registrar un nuevo doctor.
     */
    public function create()
    {
        return view('doctores.doctores'); // Vista para crear un nuevo doctor
    }

    /**
     * Almacena un nuevo doctor en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'dniDoctor' => 'required|unique:doctores,dniDoctor|max:20',
            'nombreCompleto' => 'required|string|max:255',
            'especialidad' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255',
            'fechaNacimiento' => 'nullable|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
        ]);

        // Crear un nuevo doctor
        Doctor::create($validated);

        return redirect()->route('doctores.create')->with('success', 'Doctor registrado exitosamente.');
    }

    /**
     * Muestra la lista de doctores en la tabla.
     */
    public function index()
    {
        $doctores = Doctor::all(); // Obtener todos los doctores
        return view('doctores.tabladoctores', compact('doctores'));
    }

    /**
     * Muestra el formulario para editar un doctor existente.
     */
    public function edit($idDoctor)
    {
        $doctor = Doctor::findOrFail($idDoctor); // Buscar el doctor por ID
        return view('doctores.edit', compact('doctor')); // Vista de edición
    }

    /**
     * Actualiza un doctor en la base de datos.
     */
    public function update(Request $request, $idDoctor)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'dniDoctor' => 'required|unique:doctores,dniDoctor,' . $idDoctor . ',idDoctor|max:20',
            'nombreCompleto' => 'required|string|max:255',
            'especialidad' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255',
            'fechaNacimiento' => 'nullable|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
        ]);

        // Buscar y actualizar el doctor
        $doctor = Doctor::findOrFail($idDoctor);
        $doctor->update($validated);

        return redirect()->route('doctores.index')->with('success', 'Doctor actualizado exitosamente.');
    }

    /**
     * Elimina un doctor de la base de datos.
     */
    public function destroy($idDoctor)
    {
        $doctor = Doctor::findOrFail($idDoctor);
        $doctor->delete();

        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado exitosamente.');
    }
}
