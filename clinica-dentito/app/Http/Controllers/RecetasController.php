<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\Paciente;

class RecetasController extends Controller
{
    // Listar todas las recetas
    public function index()
    {
        // Cargar recetas junto con el paciente relacionado
        $recetas = Receta::with('paciente')->get();
        return view('recetas.tablarecetas', compact('recetas'));
    }

    // Mostrar el formulario de creación de recetas
    public function create()
    {
        return view('recetas.recetas'); // Formulario para registrar recetas
    }

    // Guardar una nueva receta
    public function store(Request $request)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'dniPaciente' => 'required|exists:pacientes,dni', // Validación para dniPaciente
        'dosis' => 'required|string|max:255',
        'instrucciones' => 'required|string|max:500',
    ]);

    // Crear la receta en la base de datos
    Receta::create($validated);

    // Redirigir con mensaje de éxito
    return redirect()->route('recetas.index')->with('success', 'Receta registrada exitosamente.');
}

    // Mostrar el formulario de edición para una receta
    public function edit($id)
    {
        $receta = Receta::findOrFail($id); // Buscar la receta por ID
        return view('recetas.editarReceta', compact('receta')); // Vista para editar recetas
    }

    // Actualizar una receta
    public function update(Request $request, $id)
{
    // Validar datos
    $validated = $request->validate([
        'dniPaciente' => 'required|exists:pacientes,dni',
        'dosis' => 'required|string|max:255',
        'instrucciones' => 'required|string|max:500',
    ]);

    // Actualizar receta
    $receta = Receta::findOrFail($id);
    $receta->update($validated);

    return redirect()->route('recetas.index')->with('success', 'Receta actualizada exitosamente.');
}


    // Eliminar una receta
    public function destroy($id)
    {
        $receta = Receta::findOrFail($id); // Buscar la receta
        $receta->delete(); // Eliminarla de la base de datos

        // Redirigir con mensaje de éxito
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada exitosamente.');
    }
}
