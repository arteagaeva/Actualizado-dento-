<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Recetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1>Gestión de Recetas</h1>
        <h2>Registrar Receta</h2>

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para registrar una receta -->
        <form action="{{ route('recetas.store') }}" method="POST">
            @csrf <!-- Token de seguridad -->

            <div class="mb-3">
                <label for="dniPaciente" class="form-label">DNI del Paciente</label>
                <input type="text" id="dniPaciente" name="dniPaciente" class="form-control" placeholder="DNI del Paciente" value="{{ old('dniPaciente') }}" required>
            </div>

            <div class="mb-3">
                <label for="dosis" class="form-label">Dosis</label>
                <input type="text" id="dosis" name="dosis" class="form-control" placeholder="Dosis" value="{{ old('dosis') }}" required>
            </div>

            <div class="mb-3">
                <label for="instrucciones" class="form-label">Instrucciones</label>
                <input type="text" id="instrucciones" name="instrucciones" class="form-control" placeholder="Instrucciones" value="{{ old('instrucciones') }}" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Registrar Receta</button>
            </div>
        </form>

        <!-- Botón para consultar la tabla de recetas -->
        <div class="text-center mt-4">
            <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Consultar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
