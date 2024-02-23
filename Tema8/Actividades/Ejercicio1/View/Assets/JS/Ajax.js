function loadJSON() {
    var movimientosJSON = "./View/Assets/JSON/Movimientos.json";

    fetch(movimientosJSON)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar el archivo JSON");
            }
            return response.json();
        })

        .then(jsonArray => {
            // Verificar si el array de movimientos está definido y es un array
            if (Array.isArray(jsonArray[0]?.movimientos)) {
                console.log(jsonArray[0]?.movimientos);
                cargarMovimientos(jsonArray[0]?.movimientos);
            } else {
                console.error("El array de movimientos no está definido o no es un array.");
            }
        })

        .catch(error => {
            console.error(error.message);
        });
}


function cargarMovimientos(movimientos) {
    let movimientoContainer = document.getElementById("movimientos");
    movimientoContainer.innerHTML = ""; // Limpiar el contenedor antes de agregar nuevos elementos

    var searchInput = document.getElementById('search').value.toLowerCase();

    console.log(movimientos);

    // Verificar si 'movimientos' está definido y es un array
    if (Array.isArray(movimientos)) {
        movimientos.forEach(function (movimiento) {
            // Mostrar todos los movimientos si el campo de búsqueda está vacío
            if (movimiento &&
                movimiento['concepto'] &&
                movimiento['fecha'] &&
                (searchInput === '' ||
                    movimiento['concepto'].toLowerCase().includes(searchInput) ||
                    movimiento['fecha'].toLowerCase().includes(searchInput))
            ) {
                let tipo = (movimiento['tipo'] == 'Ingreso') ? 'ingreso' : 'retiro';
                let movimientoDiv = document.createElement("div");
                movimientoDiv.className = 'movimiento ' + tipo;
                movimientoDiv.innerHTML = "<p>Tipo: " + movimiento['tipo'] + "<br>" +
                    "Cantidad: " + movimiento['cantidad'] + " euros<br>" +
                    "Concepto: " + movimiento['concepto'] + "<br>" +
                    "Fecha: " + movimiento['fecha'] + "</p>";
                movimientoContainer.appendChild(movimientoDiv);
            }
        });
    } else {
        console.error("El array de movimientos no está definido o no es un array.");
    }
}
