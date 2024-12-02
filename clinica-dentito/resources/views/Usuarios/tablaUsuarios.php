<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../css/EstiloUsuarios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: #003366;
        }
    </style>
</head>
<body>
    <div class="titulo"></div>
    <div class="container">
        <div class="table-container">
            <h1>Gestión de Usuarios</h1>
            <h2>Lista de Usuarios</h2>

            <!-- Buscador -->
            <input type="text" id="buscador" class="form-control" placeholder="Buscar en la tabla...">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="font-size: 25px;">ID</th>
                        <th scope="col" style="font-size: 25px;">Nombre Completo</th>
                        <th scope="col" style="font-size: 25px;">Usuario</th>
                        <th scope="col" style="font-size: 25px;">Email</th>
                        <th style="font-size: 20px;">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaUsuarios">
                    <!-- Los datos de los usuarios serán generados dinámicamente con JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Formulario emergente para editar usuario -->
        <div id="overlay" onclick="closeEditForm()" style="display: none;"></div>
        <div id="editForm" style="display: none;">
            <form id="formEditar">
                <input type="hidden" id="editId">
                <!-- Campos del formulario -->
                <div class="mb-3">
                    <label for="editNombreCompleto" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="editNombreCompleto" required>
                    <label for="editUsuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="editUsuario" required>
                    <label for="editEmail" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="editEmail" required>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Datos estáticos
        const usuarios = [
            { id: 1, nombre: "Juan Pérez", usuario: "jperez", email: "juan.perez@gmail.com" },
            { id: 2, nombre: "Ana Gómez", usuario: "agomez", email: "ana.gomez@gmail.com" },
            { id: 3, nombre: "Luis Torres", usuario: "ltorres", email: "luis.torres@gmail.com" },
        ];

        const tablaUsuarios = document.getElementById('tablaUsuarios');
        const buscador = document.getElementById('buscador');

        // Renderizar la tabla
        function renderTabla() {
            tablaUsuarios.innerHTML = '';
            usuarios.forEach(usuario => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td style="font-size: 19px;">${usuario.id}</td>
                    <td style="font-size: 19px;">${usuario.nombre}</td>
                    <td style="font-size: 19px;">${usuario.usuario}</td>
                    <td style="font-size: 19px;">${usuario.email}</td>
                    <td>
                        <a class="btn-modificar" title="Editar" onclick="showEditForm(${usuario.id})"></a>
                        <a class="btn-eliminar" title="Eliminar" onclick="eliminarUsuario(${usuario.id})"></a>
                    </td>
                `;
                tablaUsuarios.appendChild(fila);
            });
        }

        // Buscar en la tabla
        buscador.addEventListener('keyup', function () {
            const filtro = this.value.toLowerCase();
            const filas = tablaUsuarios.querySelectorAll('tr');
            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? '' : 'none';
            });
        });

        // Mostrar el formulario de edición
        function showEditForm(id) {
            const usuario = usuarios.find(u => u.id === id);
            if (usuario) {
                document.getElementById('editId').value = usuario.id;
                document.getElementById('editNombreCompleto').value = usuario.nombre;
                document.getElementById('editUsuario').value = usuario.usuario;
                document.getElementById('editEmail').value = usuario.email;
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('editForm').style.display = 'block';
            }
        }

        // Cerrar el formulario de edición
        function closeEditForm() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('editForm').style.display = 'none';
        }

        // Guardar cambios en el formulario de edición
        document.getElementById('formEditar').addEventListener('submit', function (event) {
            event.preventDefault();
            const id = parseInt(document.getElementById('editId').value);
            const nombre = document.getElementById('editNombreCompleto').value;
            const usuario = document.getElementById('editUsuario').value;
            const email = document.getElementById('editEmail').value;

            const usuarioEditado = usuarios.find(u => u.id === id);
            if (usuarioEditado) {
                usuarioEditado.nombre = nombre;
                usuarioEditado.usuario = usuario;
                usuarioEditado.email = email;
                renderTabla();
                closeEditForm();
            }
        });

        // Eliminar usuario
        function eliminarUsuario(id) {
            const index = usuarios.findIndex(u => u.id === id);
            if (index !== -1) {
                usuarios.splice(index, 1);
                renderTabla();
            }
        }

        // Inicializar la tabla
        renderTabla();
    </script>
</body>
</html>
