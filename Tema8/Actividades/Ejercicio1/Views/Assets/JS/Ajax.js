function filtrarArticulos(){
    var input = document.getElementById("busqueda");
    var filter = input.value.trim();  
    var contenedor = document.getElementById("articulos-lista"); 

    var scrollPosition = document.documentElement.scrollTop;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            contenedor.innerHTML = xhr.responseText;

            setTimeout(function(){
                document.documentElement.scrollTop = scrollPosition;
            }, 0);
            
        }else{
            console.error("Error en la solicitud AJAX");
        }
    };

    // Hacemos una petición con el valor introducido en el input al fichero Articulos que se encarga de mostrar los artículos que obtiene.
    xhr.open("GET", "Views/Articulos.php?search=" + encodeURIComponent(filter), true);
    xhr.send();
}

function cargarCategorias(){
    var xhr = new XMLHttpRequest();
  
    xhr.onreadystatechange = function(){
      if(xhr.readyState === 4){
        if(xhr.status === 200){
          try {
            // Obtenemos los datos de Categorias.php
            var categorias = JSON.parse(xhr.responseText);
  
            // Obtenemos el elemento select donde cargaremos las categorías en los option.
            var selectCategorias = document.getElementById('categorias');
  
            // Limpiamos el select antes de añadir las categorías para evitar redundancias.
            selectCategorias.innerHTML = "<option value='' selected>Ver categorías</option>";
  
            // Recorremos cada categoría obtenida y creamos un option en el select para cada una. 
            categorias.forEach(function(categoria){
              var option = document.createElement('option');
              option.value = categoria;
              option.text = categoria;
  
              // Añadimos el option con la categoría al select.
              selectCategorias.add(option);
            });
          }catch(error){
            console.error('Error parsing JSON:', error);
          }
        }else{
          console.error('Error HTTP:', xhr.statusText);
        }
      }
    };
  
    // Hacemos una petición al fichero Categorias.php que devuelve en formato json todas las categorías disponibles obtenidas de la base de datos.
    xhr.open('GET', 'Views/Categorias.php', true);
    xhr.setRequestHeader('Accept', 'application/json');
    xhr.send();
}
  
document.addEventListener('DOMContentLoaded', function(){
    cargarCategorias();
});