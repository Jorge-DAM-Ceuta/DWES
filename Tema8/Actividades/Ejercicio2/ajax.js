function cargarDatos(){
    //Creamos un objeto XMLHttpRequest para realizar las peticiones al servidor. 
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            //Obtenemos los datos del servidor en formato texto.
            var data = JSON.parse(xhr.responseText);

            // Rellenamos el primer select con las provincias.
            rellenarSelect('provincias', data.provincias);

            // Asignamos el valor por defecto al primer select.
            var provinciaSelect = document.getElementById('provincias');

            var defaultProvinciaOption = document.createElement('option');
            defaultProvinciaOption.value = '';
            defaultProvinciaOption.text = 'Seleccione una provincia';
            defaultProvinciaOption.selected = true;

            // Insertamos el elemento por defecto al principio de la lista
            provinciaSelect.insertBefore(defaultProvinciaOption, provinciaSelect.firstChild)
            
            // Rellenamos el segundo select con los municipios al cambiar la provincia seleccionada.
            document.getElementById('provincias').addEventListener('change', function(){
                var idProvincia = this.value;

                var municipiosFiltrados = data.municipios.filter(function(municipio){
                    return municipio.idProvincia == idProvincia;
                });

                rellenarSelect('municipios', municipiosFiltrados);
            });
            
        }
    };

    // Hacemos la petición al servidor
    xhr.open("GET", "./server.php", true);
    xhr.send();
}

function rellenarSelect(idSelect, data){
    // Obtenemos el select específico y lo seteamos a cadena vacía para el intercambio de datos.
    var select = document.getElementById(idSelect);
    select.innerHTML = '';

    // Rellenamos las etiquetas option con el id de cada elemento y su nombre. 
    data.forEach(function(item){
        var option = document.createElement('option');
        
        option.value = item.id;
        option.text = item.municipio || item.provincia;

        select.add(option);
    });
}
