<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Muestra la lista de todos los pacientes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pacientes = Paciente::all();  // Obtener todos los pacientes
        return view('Pacientes.TablaPacientes', compact('pacientes'));  // Mostrar la lista
    }

    /**
     * Muestra el formulario para registrar un nuevo paciente.
     *
     * @return \Illuminate\View\View
     */
    public function create()
{
    return view('pacientes.pacientes');  // Vista del formulario de registro
}

    /**
     * Guarda un nuevo paciente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
    // Validación de datos
    $validated = $request->validate([
        'nombreCompleto' => 'required|string|max:255',
        'dni' => 'required|string|max:20|unique:pacientes,dni',
        'email' => 'required|email|max:100',
        'telefono' => 'required|string|max:15',
        'fechaNacimiento' => 'required|date',
        'direccion' => 'required|string|max:255',
        'genero' => 'required|in:Masculino,Femenino,Otro',
    ]);

    // Guardar paciente utilizando solo los campos validados
    Paciente::create($validated); // Esto creará un paciente usando los datos validados

    // Redirigir a la lista de pacientes con un mensaje de éxito
    return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente.');
    }


    /**
     * Muestra el formulario de edición de un paciente.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);  // Obtener el paciente
        return view('Pacientes.EditarPaciente', compact('paciente'));  // Vista para editar paciente
    }

    /**
     * Actualiza los datos de un paciente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'nombreCompleto' => 'required|string|max:255',
        'dni' => 'required|string|max:20|unique:pacientes,dni,' . $id . ',idPaciente',
        'email' => 'required|email|max:100',
        'telefono' => 'required|string|max:15',
        'fechaNacimiento' => 'required|date',
        'direccion' => 'required|string|max:255',
        'genero' => 'required|in:Masculino,Femenino,Otro',
    ]);

    // Buscar el paciente por ID y actualizar
    $paciente = Paciente::findOrFail($id);
    $paciente->update($validated);

    // Redirigir a la lista de pacientes con un mensaje de éxito
    return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado exitosamente.');
}

    /**
     * Elimina un paciente de la base de datos.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);  // Obtener paciente a eliminar
        $paciente->delete();  // Eliminar paciente

        // Redirigir a la lista de pacientes
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente.');
    }
}
