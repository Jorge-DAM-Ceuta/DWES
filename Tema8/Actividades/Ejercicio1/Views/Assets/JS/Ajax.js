function filtrarArticulos() {
    var input = document.getElementById("busqueda");
    var filter = input.value.trim();  
    var contenedor = document.getElementById("articulos-lista"); 

    var scrollPosition = document.documentElement.scrollTop;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                contenedor.innerHTML = xhr.responseText;

                setTimeout(function() {
                    document.documentElement.scrollTop = scrollPosition;
                }, 0);
            
            } else {
                console.error("Error en la solicitud AJAX");
            }
        }
    };

    xhr.open("GET", "Views/Articulos.php?search=" + encodeURIComponent(filter), true);
    xhr.send();
}

function cargarCategorias() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var categorias = JSON.parse(xhr.responseText);

            // Limpiar y cargar las opciones del select.
            var selectCategorias = document.getElementById('categorias');
            selectCategorias.innerHTML = "<option value='' selected>Selecciona una categoría</option>";

            categorias.forEach(function (categoria) {
                var option = document.createElement('option');
                option.value = categoria;
                option.text = categoria;
                selectCategorias.add(option);
            });
        }
    };

    xhr.open('GET', 'getCategoriasAjax.php', true);
    xhr.send();
}

// Llamar a cargarCategorias al cargar la página.
window.onload = function () {
    cargarCategorias();
};