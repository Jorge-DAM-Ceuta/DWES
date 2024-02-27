function eliminarMensaje(){
    let mensaje = document.querySelector("h2");

    //Al pasar un segundo:  
    setTimeout(() => {
        //Eliminamos el mensaje de confirmación.
        mensaje.remove();

        /*Restablecemos la URL para no tener el valor obtenido por GET, evitando 
        que al recargar la página se muestre de nuevo el mensaje.*/
        history.replaceState({}, document.title, window.location.pathname);
    }, 1000);
}