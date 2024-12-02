<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Pacientes</h1>
        <h2>Lista de Pacientes</h2>
        <button onclick="confirmarRegistro()" class="btn btn-success mb-3">Registrar Nuevo Paciente</button>
        <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar en la tabla...">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Dirección</th>
                    <th>Género</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->idPaciente }}</td>
                        <td>{{ $paciente->nombreCompleto }}</td>
                        <td>{{ $paciente->dni }}</td>
                        <td>{{ $paciente->email }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        <td>{{ $paciente->fechaNacimiento }}</td>
                        <td>{{ $paciente->direccion }}</td>
                        <td>{{ $paciente->genero }}</td>
                        <td>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('pacientes.destroy', $paciente->idPaciente) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                            <!-- Botón para editar -->
                            <a href="{{ route('pacientes.edit', $paciente->idPaciente) }}" class="btn btn-warning">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Función para filtrar la tabla de pacientes
        const buscador = document.getElementById('buscador');
        const tablaPacientes = document.querySelector('tbody');

        buscador.addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const filas = tablaPacientes.querySelectorAll('tr');
            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? '' : 'none';
            });
        });
        function confirmarRegistro() {
            const confirmacion = confirm("¿Deseas registrar un nuevo paciente?");
            if (confirmacion) {
                // Redirige a la página de registro de pacientes
                window.location.href = "{{ route('pacientes.create') }}"; // Ruta para crear paciente
            }
        }
    </script>
</body>
</html>
