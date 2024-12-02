<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../EstiloCitas.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #2457a4;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text mb-4">
            <h1>Gestión de Citas</h1>
            <h2>Registrar Cita</h2>
        </div>
        <form action="{{ route('citas.store') }}" method="POST" class="form-container">
            @csrf
            <div class="mb-3">
                <label for="idPaciente" class="form-label">ID Paciente</label>
                <input type="number" id="idPaciente" name="idPaciente" class="form-control" placeholder="ID del Paciente" required>
            </div>
            <div class="mb-3">
                <label for="idDoctor" class="form-label">ID Doctor</label>
                <input type="number" id="idDoctor" name="idDoctor" class="form-control" placeholder="ID del Doctor" required>
            </div>
            <div class="mb-3">
                <label for="idTratamiento" class="form-label">ID Tratamiento</label>
                <input type="number" id="idTratamiento" name="idTratamiento" class="form-control" placeholder="ID del Tratamiento" required>
            </div>
            <div class="mb-3">
                <label for="fechaCita" class="form-label">Fecha de la Cita</label>
                <input type="date" id="fechaCita" name="fechaCita" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select id="estado" name="estado" class="form-control" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmada">Confirmada</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" id="motivo" name="motivo" class="form-control" placeholder="Motivo de la Cita" required>
            </div><br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="btnRegistrar" value="ok">Registrar Cita</button>
            </div>
        </form>
        
        <!-- Botón para consultar las citas -->
        <div class="text-center mt-4">
            <a href="{{ route('citas.index') }}" class="btn btn-secondary">Consultar Citas</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
