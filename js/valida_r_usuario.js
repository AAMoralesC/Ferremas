function validarRut(rut) {
    // Eliminar caracteres no válidos
    rut = rut.replace(/[^0-9kK]/g, '');

    if (rut.length < 2) {
        return null;
    }

    // Separa el dígito verificador
    const dv = rut.slice(-1);
    const num = rut.slice(0, -1);

    // Formatear con guión
    const rutFormat = num + '-' + dv;

    return rutFormat;
}

document.getElementById('rut').addEventListener('input', function () {
    const inputValue = this.value;
    const formattedRut = validarRut(inputValue);
    if (formattedRut !== null) {
        this.value = formattedRut;
    }
});
// campos restantes
function validarFormulario() {
    // Obtener los valores de los campos del formulario
    const nombre = document.getElementById('nombre').value;
    const paterno = document.getElementById('paterno').value;
    const cargo = document.getElementById('cargo').value;
    const especialidad = document.getElementById('especialidad').value;
    const direccion = document.getElementById('direccion').value;
    const correo = document.getElementById('correo').value;
    const celular = document.getElementById('celular').value;
    const clave = document.getElementById('clave').value;
    const confirmar = document.getElementById('confirmar').value;

    // Validar otros campos
    if (nombre.trim() === '') {
        alert('El campo "Nombres" es obligatorio.');
        return false; // Detener el envío del formulario
    }

    if (paterno.trim() === '') {
        alert('El campo "Apellido Paterno" es obligatorio.');
        return false; 
    }

    if (cargo === '') {
        alert('Debes seleccionar un "Cargo".');
        return false; 
    }

    if (especialidad === '') {
        alert('Debes seleccionar una "Especialidad".');
        return false; 
    }

    if (direccion.trim() === '') {
        alert('El campo "Dirección" es obligatorio.');
        return false; 
    }

    if (correo.trim() === '') {
        alert('El campo "Correo Electrónico" es obligatorio.');
        return false; 
    }

    if (celular.trim() === '') {
        alert('El campo "Número de celular" es obligatorio.');
        return false; 
    }

    if (clave.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false; 
    }

    if (clave !== confirmar) {
        alert('Las contraseñas no coinciden.');
        return false;
    }

    const tieneMayus = /[A-Z]/.test(clave);
    const tinenMinus = /[a-z]/.test(clave);
    const tieneNum = /\d/.test(clave);
    const tieneCaract = /[!@#\$%\^&\*]/.test(clave); 
    if(!(tieneMayus && tinenMinus && tieneNum && tieneCaract)){
    alert('La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.');
    return false;
    }
    // Si todo está correcto, envia el formulario
    return true;
}


document.getElementById('formulario').addEventListener('submit', function (event) {
    if (!validarFormulario()) {
        event.preventDefault(); // Detener el envío del formulario
    }
});
