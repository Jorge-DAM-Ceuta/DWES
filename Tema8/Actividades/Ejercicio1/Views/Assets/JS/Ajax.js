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