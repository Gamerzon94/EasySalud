function validar(){
    
    var email = document.getElementById("email").value;
    var email2 = document.getElementById("email2").value;
    var tel = document.getElementById("tel").value;
    var cel = document.getElementById("cel").value;
    var cla = document.getElementById("cla").value;
    var cla2 = document.getElementById("cla2").value;
    var hoy = document.getElementById("hoy").value;
    var fechaNacimiento = document.getElementById("fechaNacimiento").value;
    if(email != email2){
        alert("Los email no coinciden");
        return false;
    }
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email)){
    } else {
        alert("La dirección de email no es valida.");
        return false;
   }
   if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email2)){
    } else {
        alert("La dirección de email no es valida.");
        return false;
   }
   if(!(tel==0)){
    if( !(/^\d{9}$/.test(tel)) ) {
        alert("Telefono invalido, intente de la forma \"222222222\"");
        return false;
    }
   }
   if( !(/^\d{9}$/.test(cel)) ) {
       alert("Telefono movil invalido, intente de la forma \"999999999\"");
       return false;
   }
   if(cla != cla2){
       alert("Las claves no coinciden.");
       return false;
   }
}

function mensajeError(){
    alert("Usuario o clave incorrectos.");
    window.location.href='index.php';
}

function usuarioNoAutorizado(){
    alert("La cuenta no se encuentra activa.");
    window.location.href='index.php';
}

function validarRegistro(){
    var horasDesde = document.getElementById("desdeh").selectedIndex;
    var minutosDesde = document.getElementById("desdem").selectedIndex;
    var horasHasta = document.getElementById("hastah").selectedIndex;
    var minutosHasta = document.getElementById("hastam").selectedIndex;
    
    if(horasHasta < horasDesde){
        alert("La hora de termino no puede ser menor que la hora de comienzo.");
        return false;
    }
    if(horasHasta == horasDesde){
        if(minutosHasta < minutosDesde){
            alert("La hora de termino no puede ser menor que la hora de comienzo.");
            return false;
        }
    }
}

function validarDireccion(){
    var region = document.getElementById("region").selectedIndex;
    var comuna = document.getElementById("comuna").selectedIndex;
    var direccion = document.getElementById("dir").value;
    var opDir=document.getElementsByName("opDir");
    var resultado = "";
    for(var i=0;i<opDir.length;i++){
        if(opDir[i].checked){
            resultado=opDir[i].value;
        }
    }
    if(resultado == 'no'){
        if(region == 0){
            alert("Seleccione una region");
            return false;
        }
        if(comuna == 0){
            alert("Seleccione una comuna");
            return false;
        }
        if((direccion == '') || (direccion == ' ')){
            alert("Debe escribir una dirección");
            return false;
        }
    }
}

