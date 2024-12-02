<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Doctores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            background-color: #2457a4;
        }

        .container {
            max-width: 1500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
        }

        #editForm {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1001;
            width: 50%;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Doctores</h1>
        <h2>Lista de Doctores</h2>

        <!-- Buscador -->
        <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar en la tabla...">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Doctor</th>
                    <th>DNI</th>
                    <th>Nombre Completo</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctores as $doctor)
                    <tr>
                        <td>{{ $doctor->idDoctor }}</td>
                        <td>{{ $doctor->dniDoctor }}</td>
                        <td>{{ $doctor->nombreCompleto }}</td>
                        <td>{{ $doctor->especialidad }}</td>
                        <td>{{ $doctor->telefono }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>{{ $doctor->direccion }}</td>
                        <td>
                            <!-- Botón para editar -->
                            <!-- <button class="btn btn-warning" onclick="showEditForm(
                            {{ $doctor->idDoctor }},
                            '{{ $doctor->dniDoctor }}',
                            '{{ $doctor->nombreCompleto }}',
                            '{{ $doctor->especialidad }}',
                            '{{ $doctor->telefono }}',
                            '{{ $doctor->email }}',
                            '{{ $doctor->direccion }}'
                            )">Editar</button>-->

                            <!-- Formulario de eliminación -->
                            <form action="{{ route('doctores.destroy', $doctor->idDoctor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Enlace para registrar un nuevo doctor -->
        <a href="{{ route('doctores.create') }}" class="btn btn-primary">Registrar Nuevo Doctor</a>
    </div>

    <!-- Formulario emergente para editar doctor -->
<div id="overlay" onclick="closeEditForm()" style="display: none;"></div>
<div id="editForm" style="display: none;">
    <form id="formEditar" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="editIdDoctor" name="idDoctor">
        
        <div class="mb-3">
            <label for="editDniDoctor" class="form-label">DNI Doctor</label>
            <input type="text" class="form-control" id="editDniDoctor" name="dniDoctor" required>
        </div>

        <div class="mb-3">
            <label for="editNombreCompleto" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="editNombreCompleto" name="nombreCompleto" required>
        </div>

        <div class="mb-3">
            <label for="editEspecialidad" class="form-label">Especialidad</label>
            <input type="text" class="form-control" id="editEspecialidad" name="especialidad" required>
        </div>

        <div class="mb-3">
            <label for="editTelefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="editTelefono" name="telefono">
        </div>

        <div class="mb-3">
            <label for="editEmail" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="editEmail" name="email">
        </div>

        <div class="mb-3">
            <label for="editDireccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="editDireccion" name="direccion">
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <button type="button" class="btn btn-secondary" onclick="closeEditForm()">Cancelar</button>
        </div>
    </form>
</div>


<script>
    function showEditForm(idDoctor, dniDoctor, nombreCompleto, especialidad, telefono, email, direccion) {
        // Configurar la acción del formulario para la actualización
        const form = document.getElementById('formEditar');
        form.action = `{{ url('doctores') }}/${idDoctor}`;


        // Rellenar los campos del formulario con los datos seleccionados
        const fields = {
            editIdDoctor: idDoctor,
            editDniDoctor: dniDoctor,
            editNombreCompleto: nombreCompleto,
            editEspecialidad: especialidad,
            editTelefono: telefono,
            editEmail: email,
            editDireccion: direccion
        };

        Object.entries(fields).forEach(([id, value]) => {
            document.getElementById(id).value = value;
        });

        // Mostrar el formulario y el overlay
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('editForm').style.display = 'block';
    }

    function closeEditForm() {
        // Ocultar el formulario y el overlay
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('editForm').style.display = 'none';
    }

    // Filtrado de tabla
    document.getElementById('buscador').addEventListener('keyup', function () {
        const filtro = this.value.toLowerCase();
        document.querySelectorAll('tbody tr').forEach(fila => {
            fila.style.display = fila.textContent.toLowerCase().includes(filtro) ? '' : 'none';
        });
    });
</script>
</body>
</html>
