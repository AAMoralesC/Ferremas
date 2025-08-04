$(document).ready(function() {

    $("#formulario").submit(function(event){


        let rut = $("#rut").val();
        let appaterno = $("#apPaterno").val().charAt(0).toUpperCase() + $("#apPaterno").val().slice(1).toLowerCase();
        let apmaterno = $("#apMaterno").val().charAt(0).toUpperCase() + $("#apMaterno").val().slice(1).toLowerCase();
        let nombre = $("#nombre").val().charAt(0).toUpperCase() + $("#nombre").val().slice(1).toLowerCase();
        let genero = $("#genero").val();
        let email = $("#email").val();
        let celular = $("#celular").val();
        let profesion = $("#pass").val().toLowerCase();

        let sr = "";
        let texto = "";

        let validacion = true;

        //Validación de RUT
        if(rut.length < 9 || rut.length > 10){
            $("#mrut").html("El rut debe contener entre 9 y 10 digitos.");
            validacion = false;
        }
        else{
            $("#mrut").html("");
        }

        //Validación de apellido paterno
        if(appaterno.length < 3 || appaterno.length > 20){
            $("#mapPaterno").html("El apellido paterno debe contener entre 3 y 20 caracteres.");
            validacion = false;
        }
        else{
            $("#mapPaterno").html("");
        }

        //Validación de apellido materno
        if(apmaterno.length < 3 || apmaterno.length > 20){
            $("#mapMaterno").html("El apellido materno debe contener entre 3 y 20 caracteres.");
            validacion = false;
        }
        else{
            $("#mapMaterno").html("");
        }
        
        //Validación de nombre
        if(nombre.length < 3 || nombre.length > 20){
            $("#mnombre").html("El nombre debe contener entre 3 y 20 caracteres.");
            validacion = false;
        }
        else{
            $("#mnombre").html("");
        }
        
        
        
        //Validación de email
        if(email.length <= 0){
            $("#memail").html("Debe ingresar la dirección de correo eléctronico.");
            validacion = false;
        }
        else{
            $("#memail").html("");
        }
        
        //Validación de Celular
        if(celular.length < 9 || celular.length > 12){
            $("#mcelular").html("El número de celular debe contener entre 9 y 12 dígitos.");
            validacion = false;
        }
        else{
            $("#mcelular").html("");
        }
        
        //Validación de Profesión
        if(profesion.length <= 0){
            $("#pass").html("Debe ingresar la contraseña.");
            validacion = false;
        }
        else{
            $("#mprofesion").html("");
        }
        
       if(validacion ==  true){
       }
       else
       {
            event.preventDefault();
       }

    });

})