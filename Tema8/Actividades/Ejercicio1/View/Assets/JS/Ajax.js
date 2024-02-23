function loadJSON(){
    var movimientosJSON = "./View/Assets/JSON/Movimientos.json";
    var http_request = new XMLHttpRequest();
    
    try{
       // Opera 8.0+, Firefox, Chrome, Safari
       http_request = new XMLHttpRequest();
    }catch(error){
       // Internet Explorer Browsers
       try{
          http_request = new ActiveXObject("Msxml2.XMLHTTP");  
       }catch(error){
          try{
             http_request = new ActiveXObject("Microsoft.XMLHTTP");
          }catch(error){
            // Something went wrong
            alert("Your browser broke!");
            return false;
          }
            
       }
    }
    
    http_request.onreadystatechange = function(){
       if(http_request.readyState == 4){
          // Javascript function JSON.parse to parse JSON data
          var jsonObj = JSON.parse(http_request.responseText);

          // jsonObj variable now contains the data structure and can
          // be accessed as jsonObj.name and jsonObj.country.
          let movimientoContainer = document.getElementById("movimientos");

          console.log(movimientoContainer);
          console.log(jsonObj[0]["movimientos"]);
       }
    }
    
    http_request.open("GET", movimientosJSON, true);
    http_request.send();
}

function ingresarDinero(){

}

function retirarDinero(){
    
}