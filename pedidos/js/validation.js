$(document).ready(function() {
    $("#formulario").submit(function(event){

    let user = $("#usuario").val();
    let pass =$("#password").val();

    if(user==""|| pass=="")
    {
        $("#error").html(' • Debe completar usuario y password.');
        $("#error").addClass('cuadroError');
        return false
    }
    else
    {
        //$('#formulario').attr('action', 'index.html');
    }
});

});


