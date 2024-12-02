<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="../css/EstiloCitas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
    <style>
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
        /* Estilo para el formulario emergente */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1;
        }
        #editForm {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            z-index: 2;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Citas</h1>
        <h2>Lista de Citas</h2>

        <!-- Buscador -->
        <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar en la tabla...">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Cita</th>
                    <th>ID Paciente</th>
                    <th>ID Doctor</th>
                    <th>Tratamiento</th>
                    <th>Fecha Cita</th>
                    <th>Estado</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaCitas">
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->idCita }}</td>
                        <td>{{ $cita->idPaciente }}</td>
                        <td>{{ $cita->idDoctor }}</td>
                        <td>{{ $cita->idTratamiento }}</td>
                        <td>{{ $cita->fechaCita }}</td>
                        <td>{{ $cita->estado }}</td>
                        <td>{{ $cita->motivo }}</td>
                        <td>
                            <!-- Botón para editar -->
                            <button class="btn btn-warning" onclick="showEditForm({{ $cita->idCita }}, '{{ $cita->idPaciente }}', '{{ $cita->idDoctor }}', '{{ $cita->idTratamiento }}', '{{ $cita->fechaCita }}', '{{ $cita->estado }}', '{{ $cita->motivo }}')">Editar</button>

                            <!-- Formulario de eliminación -->
                            <form action="{{ route('citas.destroy', $cita->idCita) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario emergente para editar cita -->
        <div id="overlay" onclick="closeEditForm()" style="display: none;"></div>
        <div id="editForm" style="display: none;">
            <form id="formEditar">
                <input type="hidden" id="editIdCita">
                <!-- Campos del formulario -->
                <div class="mb-3">
                    <label for="editIdPaciente" class="form-label">ID Paciente</label>
                    <input type="text" class="form-control" id="editIdPaciente" required>

                    <label for="editIdDoctor" class="form-label">ID Doctor</label>
                    <input type="text" class="form-control" id="editIdDoctor" required>

                    <label for="editIdTratamiento" class="form-label">ID Tratamiento</label>
                    <input type="text" class="form-control" id="editIdTratamiento" required>

                    <label for="editFechaCita" class="form-label">Fecha Cita</label>
                    <input type="date" class="form-control" id="editFechaCita" required>

                    <label for="editEstado" class="form-label">Estado</label>
                    <select class="form-control" id="editEstado" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Confirmada">Confirmada</option>
                        <option value="Cancelada">Cancelada</option>
                    </select>

                    <label for="editMotivo" class="form-label">Motivo</label>
                    <input type="text" class="form-control" id="editMotivo" required>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>

        <!-- Botón para consultar las citas -->
        <div class="text-center mt-4">
            <a href="{{ route('citas.index') }}" class="btn btn-secondary">Consultar Citas</a>
        </div>
    </div>

    <script>
        // Función para mostrar el formulario de edición con los datos de la cita seleccionada
        function showEditForm(idCita, idPaciente, idDoctor, idTratamiento, fechaCita, estado, motivo) {
            document.getElementById('editIdCita').value = idCita;
            document.getElementById('editIdPaciente').value = idPaciente;
            document.getElementById('editIdDoctor').value = idDoctor;
            document.getElementById('editIdTratamiento').value = idTratamiento;
            document.getElementById('editFechaCita').value = fechaCita;
            document.getElementById('editEstado').value = estado;
            document.getElementById('editMotivo').value = motivo;
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('editForm').style.display = 'block';
        }

        // Función para cerrar el formulario de edición
        function closeEditForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('editForm').style.display = 'none';
        }

        // Función para buscar en la tabla
        document.getElementById('buscador').addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('tr');
            filas.forEach(function (fila) {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
