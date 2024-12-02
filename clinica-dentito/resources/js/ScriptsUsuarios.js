document.getElementById('mostrar-formulario').addEventListener('click', function() {
    console.log("Botón 'Agregar Usuario' clicado"); // Depuración
    const formulario = document.getElementById('formulario-registro');
    const botonAgregar = document.getElementById('mostrar-formulario');

    // Muestra el formulario y oculta el botón de "Agregar Usuario"
    formulario.style.display = 'block';
    botonAgregar.style.display = 'none';
});
