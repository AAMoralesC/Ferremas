//Validar RUT
function validarRut(objeto) {
    let mRut = document.getElementById("mRut");
    let flag = true;
    
    if(valNumero(objeto.value) == false){
        mRut.innerHTML = "El rut solo debe contener números";
        mRut.classList.remove("text-success");
        mRut.classList.add("text-danger");
        flag = false;
    }
    else{
        if (objeto.value.length < 7) {
            mRut.innerHTML = "El rut debe contener entre 7 y 8 d&iacute;gitos";
            mRut.classList.remove("text-success");
            mRut.classList.add("text-danger");
            flag = false;
        } 
        else if ((objeto.value.length == 7 || objeto.value.length == 8)) {
            mRut.innerHTML = "Correcto &#10003;";
            mRut.classList.remove("text-danger");
            mRut.classList.add("text-success");
            flag = true;
        }
        else{
            mRut.innerHTML = "El rut debe contener entre 7 y 8 d&iacute;gitos";
            mRut.classList.remove("text-success");
            mRut.classList.add("text-danger");
            flag = false;
        }
    }
    return flag;
}

//Validar Digito verificador
function validarDv(objeto) {
    let mDv = document.getElementById("mDv");
    let flag = true;

    if(valDv(objeto.value) ==  false){
        mDv.innerHTML = "Campo inv&aacute;lido";
        mDv.classList.remove("text-success");
        mDv.classList.add("text-danger");
        flag = false;
    }
    else{
        if (objeto.value.length < 1) {
            mDv.innerHTML = "Campo obligatorio";
            mDv.classList.remove("text-success");
            mDv.classList.add("text-danger");
            flag = false;
        } 
        else if (objeto.value.length == 1) {
            mDv.innerHTML = "Correcto &#10003;";
            mDv.classList.remove("text-danger");
            mDv.classList.add("text-success");
            flag = true;
        } 
        else{
            mDv.innerHTML = "Campo acepta un d&iacute;gito o letra";
            mDv.classList.remove("text-success");
            mDv.classList.add("text-danger");
            flag = false;
        }
    }
    return flag;
}  

//Validar nombre completo
function valNombres(objeto) {
    let idDiv = objeto.id.charAt(0).toUpperCase() + objeto.id.slice(1);
    let flag = true;

    if(valLetra(objeto.value) ==  false){
        document.getElementById("m"+idDiv).innerHTML = "Solo ingrese letras";
        document.getElementById("m"+idDiv).classList.remove("text-success");
        document.getElementById("m"+idDiv).classList.add("text-danger");
        flag = false;
    }
    else{
        if (objeto.value.length < 3) {
            document.getElementById("m"+idDiv).innerHTML = "Debe contener entre 3 y 20 caracteres";
            document.getElementById("m"+idDiv).classList.remove("text-success");
            document.getElementById("m"+idDiv).classList.add("text-danger");
            flag = false;
        } 
        else {                       
            document.getElementById("m"+idDiv).innerHTML = "Correcto &#10003;";
            document.getElementById("m"+idDiv).classList.remove("text-danger");
            document.getElementById("m"+idDiv).classList.add("text-success");
            flag = true;
        }  
    }
    return flag;   
}

//Validar código de celular
function valCodigo(objeto){
    let mCodTel = document.getElementById("mCodTel");
    let flag = true;
    let idx = objeto.selectedIndex;
    let opcion = objeto.options[idx];

    if(opcion.value == "Código"){
        mCodTel.innerHTML = "Seleccione un c&oacute;digo";
        mCodTel.classList.remove("text-success");
        mCodTel.classList.add("text-danger");
        flag = false;
    }
    else if(opcion.value != "Código"){
        mCodTel.innerHTML = "Correcto &#10003;";
        mCodTel.classList.remove("text-danger");
        mCodTel.classList.add("text-success");
        flag = true;
    }
    return flag;
}

//Validar celular
function valCelular(objeto){
    let mTelefono = document.getElementById("mTelefono");
    let flag = true;

    if(valNumero(objeto.value) == false){
        mTelefono.innerHTML = "Solo debe contener n&uacute;meros";
        mTelefono.classList.remove("text-success");
        mTelefono.classList.add("text-danger");
        flag = false;
    }
    else{
        if(objeto.value.toString().length < 9){
            mTelefono.innerHTML = "El n&uacute;mero de celular debe tener 9 d&iacute;gitos";
            mTelefono.classList.remove("text-success");
            mTelefono.classList.add("text-danger");
            flag = false;
        }
        else if(objeto.value.toString().length == 9){
            mTelefono.innerHTML = "Correcto &#10003;";
            mTelefono.classList.remove("text-danger");
            mTelefono.classList.add("text-success");
            flag = true;
        }
        else {
            mTelefono.innerHTML = "El n&uacute;mero de celular supera los 9 d&iacute;gitos";
            mTelefono.classList.remove("text-success");
            mTelefono.classList.add("text-danger");
            flag = false;
        }
    } 
    return flag;
}

//Validar email
function valCorreo(objeto){
    let mCorreo = document.getElementById("mCorreo");
    let flag = true;

    if(objeto.value.length <= 5){
        mCorreo.innerHTML = "Correo Electr&oacute;nico err&oacute;neo";
        mCorreo.classList.remove("text-success");
        mCorreo.classList.add("text-danger");
        flag = false;
    }
    else if(objeto.value.length > 5){
        mCorreo.innerHTML = "Correcto &#10003;";
        mCorreo.classList.remove("text-danger");
        mCorreo.classList.add("text-success");
        flag = true;
    }
    else {
        mCorreo.innerHTML = "Correo Electr&oacute;nico err&oacute;neo";
        mCorreo.classList.remove("text-success");
        mCorreo.classList.add("text-danger");
        flag = false;
    }
    return flag;
}

//Validar dirección
function valDireccion(objeto){
    let mDireccion = document.getElementById("mDireccion");
    let flag = true;

    if(objeto.value.length <= 5){
        mDireccion.innerHTML = "Direcci&oacute;n inv&aacute;lida";
        mDireccion.classList.remove("text-success");
        mDireccion.classList.add("text-danger");
        flag = false;
    }
    else if(objeto.value.length > 5){
        mDireccion.innerHTML = "Correcto &#10003;";
        mDireccion.classList.remove("text-danger");
        mDireccion.classList.add("text-success");
        flag = true;
    }
    else {
        mDireccion.innerHTML = "Direcci&oacute;n inv&aacute;lida";
        mDireccion.classList.remove("text-success");
        mDireccion.classList.add("text-danger");
        flag = false;
    }
    return flag;
}

//Validar región
function valRegion(objeto){
    let mRegion = document.getElementById("mRegion");
    let flag = true;
    let idx = objeto.selectedIndex;
    let opcion = objeto.options[idx];

    if(opcion.value == "Seleccione una región"){
        mRegion.innerHTML = "Debe seleccionar una regi&oacute;n";
        mRegion.classList.remove("text-success");
        mRegion.classList.add("text-danger");
        flag = false;
    }
    else if(opcion.value != "Seleccione una región"){
        mRegion.innerHTML = "Correcto &#10003;";
        mRegion.classList.remove("text-danger");
        mRegion.classList.add("text-success");
        flag = true;
    }
    return flag;
}

//Validar comuna
function valComuna(objeto){
    let mComuna = document.getElementById("mComuna");
    let flag = true;
    let idx = objeto.selectedIndex;
    let opcion = objeto.options[idx];

    if(opcion.value == "Seleccione una comuna"){
        mComuna.innerHTML = "Debe seleccionar una comuna";
        mComuna.classList.remove("text-success");
        mComuna.classList.add("text-danger");
        flag = false;
    }
    else if(opcion.value != "Seleccione una comuna"){
        mComuna.innerHTML = "Correcto &#10003;";
        mComuna.classList.remove("text-danger");
        mComuna.classList.add("text-success");
        flag = true;
    }
    return flag;
}

//Alojar funciones de validación y verificación
function validacion(objeto){
    valClave(objeto);
    verificar();
}

// Validar contraseña y confirmación
function valClave(objeto) {
    //alert(document.getElementByTagName(objeto).id);
    
    let idDiv = objeto.id.charAt(0).toUpperCase() + objeto.id.slice(1);
    

    if (objeto.value.length < 8) {
        document.getElementById("m"+idDiv).innerHTML = "La contrase&ntilde;a debe tener al menos 8 caracteres";
        document.getElementById("m"+idDiv).classList.remove("text-success");
        document.getElementById("m"+idDiv).classList.add("text-danger");
    } 
    else if (!/[a-zA-Z]/.test(objeto.value)) {
        console.log(objeto.value);
        document.getElementById("m"+idDiv).innerHTML = "La contrase&ntilde;a debe tener al menos una letra";
        document.getElementById("m"+idDiv).classList.remove("text-success");
        document.getElementById("m"+idDiv).classList.add("text-danger");
    }
    else if (!/(?=.*\d)/.test(objeto.value)) {
        document.getElementById("m"+idDiv).innerHTML = "La contrase&ntilde;a debe tener al menos un n&uacute;mero";
        document.getElementById("m"+idDiv).classList.remove("text-success");
        document.getElementById("m"+idDiv).classList.add("text-danger");
    }
    else if (!/(?=.*[@$!%*?&.])/.test(objeto.value)) {
        document.getElementById("m"+idDiv).innerHTML = "La contrase&ntilde;a debe tener al menos un s&iacute;mbolo especial: @$!%*?&.";
        document.getElementById("m"+idDiv).classList.remove("text-success");
        document.getElementById("m"+idDiv).classList.add("text-danger");
    }
    else {                       
        document.getElementById("m"+idDiv).innerHTML = "Correcto &#10003;";
        document.getElementById("m"+idDiv).classList.remove("text-danger");
        document.getElementById("m"+idDiv).classList.add("text-success");
    }  
}


  

//Validar números
function valNumero(dato) {
    return /^[0-9]+$/.test(dato);
}

//Validar letras
function valLetra(dato) {
    return /^[a-zA-Z]+$/.test(dato);
}

//Validar dv
function valDv(dato) {
    return /^[0-9kK]{1}$/.test(dato);
}

//Verficar igualdad
function verificar() {
    let clave1 = document.getElementById("clave");
    let clave2 = document.getElementById("confirmar");

    let flag = true;

    if (clave1.value.length < 8 || clave2.value.length < 8) {
        document.getElementById("mVerificar").innerHTML = "";
        document.getElementById("mVerificar").classList.remove("text-danger");
        document.getElementById("mVerificar").classList.remove("text-success");
        flag = false;
    }
    else{
        if (clave1.value !== clave2.value) {
            document.getElementById("mVerificar").innerHTML = "Las contrase&ntilde;as no coinciden";
            document.getElementById("mVerificar").classList.remove("text-success");
            document.getElementById("mVerificar").classList.add("text-danger");
            flag = false;
        }
        else{
            document.getElementById("mVerificar").innerHTML = "La contrase&ntilde;a es v&aacute;lida &#10003;";
            document.getElementById("mVerificar").classList.remove("text-danger");
            document.getElementById("mVerificar").classList.add("text-success");
            flag = true;
        }
    }
    return flag;
}

//Enviar registro
function enviarRegistro(){

    document.getElementById("formulario").addEventListener("submit", function(event){
        
        event.preventDefault();

        let rut = validarRut(document.getElementById("rut"));
        let dv = validarDv(document.getElementById("dv"));
        let pnombre = valNombres(document.getElementById("nombre"));
        let aPaterno = valNombres(document.getElementById("paterno"));
        let aMaterno = valNombres(document.getElementById("materno"));
        let cod = valCodigo(document.getElementById("codTel"));
        let celular = valCelular(document.getElementById("telefono"));
        let correo = valCorreo(document.getElementById("correo"));
        let direccion = valDireccion(document.getElementById("direccion"));
        let region = valRegion(document.getElementById("region"));
        let comuna = valComuna(document.getElementById("comuna"));
        let flagVerificar;
        flagVerificar = verificar();
        let mensaje = "";
        let nombre = document.getElementById("nombre").value.charAt(0).toUpperCase() + document.getElementById("nombre").value.slice(1).toLowerCase();
        let paterno = document.getElementById("paterno").value.charAt(0).toUpperCase() + document.getElementById("paterno").value.slice(1).toLowerCase();
            
        document.getElementById("mensaje").classList.add("visible");
        if(rut && dv && pnombre && aPaterno && aMaterno && cod && celular && correo && direccion && region && comuna && flagVerificar){
            
            mensaje = "<h1>Bienvenido a TheCleta</h1><br>"+
                    nombre + " " + paterno + " nos alegra que estes aqu&iacute;.<br>"+
                    "TheCleta es una tienda con m&uacute;ltiples opciones de bicicletas, <br>"+
                    "la cual posee una especial gama de gran variedad, y te proporcionará las herramientas<br>"+
                    "para que escojas la que más se ajuste a tus preferencias y gustos.<br><br>";

            document.getElementById("mensaje").innerHTML = mensaje;
            document.getElementById("mensaje").classList.remove("cuadroError");
            document.getElementById("mensaje").classList.add("cuadroExito");
        }
        else{
            mensaje = "Por favor, revise los campos en rojo antes de enviar el formulario.";
            document.getElementById("mensaje").innerHTML = mensaje;
            document.getElementById("mensaje").classList.remove("cuadroExito");
            document.getElementById("mensaje").classList.add("cuadroError");
        }
    });
}

//Validar Número de seguimiento
function valSeguimiento(objeto) {
    let mSeg = document.getElementById("mSeguimiento");
    let flag = true;

    if(objeto.value == ""){
        mSeg.innerHTML = "";
        mSeg.classList.remove("text-success");
        mSeg.classList.remove("text-danger");
        flag = false;
    }
    else if(valNumero(objeto.value) == false){
        mSeg.innerHTML = "El n&uacute;mero de seguimiento no debe contener letras ni signos";
        mSeg.classList.remove("text-success");
        mSeg.classList.add("text-danger");
        flag = false;
    }
    else{
        if (objeto.value.length < 12) {
            mSeg.innerHTML = "El n&uacute;mero de seguimiento debe contener 12 d&iacute;gitos";
            mSeg.classList.remove("text-success");
            mSeg.classList.add("text-danger");
            flag = false;
        } 
        else if (objeto.value.length == 12) {
            mSeg.innerHTML = "Correcto &#10003;";
            mSeg.classList.remove("text-danger");
            mSeg.classList.add("text-success");
            flag = true;
        }
        else{
            mSeg.innerHTML = "El n&uacute;mero de seguimiento debe contener 12 d&iacute;gitos";
            mSeg.classList.remove("text-success");
            mSeg.classList.add("text-danger");
            flag = false;
        }
    }
    return flag;
}

//Realizar busqueda
function realizarSeg(){
    document.getElementById("buscar").addEventListener("click", function agregarEvento(event){

        event.preventDefault();

        let busqueda = valSeguimiento(document.getElementById("NroSeguimiento"));

        if(busqueda == true){

            document.getElementById("mBusqueda").innerHTML = "Buscando...";
            document.getElementById("mBusqueda").classList.remove("cuadroError");
            document.getElementById("mBusqueda").classList.add("cuadroExito");

            document.getElementById("mBusqueda").removeEventListener("click", agregarEvento);
        }
        else{
            document.getElementById("mBusqueda").innerHTML = "Revise su n&uacute;mero de seguimiento ingresado.";
            document.getElementById("mBusqueda").classList.remove("cuadroExito");
            document.getElementById("mBusqueda").classList.add("cuadroError");
        }
    })
}