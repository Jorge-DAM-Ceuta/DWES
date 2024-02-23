function filtrarArticulos() {
    var input = document.getElementById("busqueda");
    var filter = input.value.toUpperCase();
    var articulos = document.getElementsByClassName("articulo");

    for (var i = 0; i < articulos.length; i++) {
        var titulo = articulos[i].getElementsByTagName("h2")[0].innerText.toUpperCase();
        var contenido = articulos[i].getElementsByTagName("p")[0].innerText.toUpperCase();
        var fecha = articulos[i].getElementsByClassName("fecha")[0].innerText.toUpperCase();

        if (titulo.includes(filter) || contenido.includes(filter) || fecha.includes(filter)) {
            articulos[i].style.display = "";
        } else {
            articulos[i].style.display = "none";
        }
    }
}