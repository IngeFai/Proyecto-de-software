// Validación del formulario de inicio de sesión
document.getElementById("login").addEventListener("submit", function(event) {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (email === "" || password === "") {
        alert("Todos los campos son obligatorios");
        event.preventDefault(); // Evitar que el formulario se envíe si los campos están vacíos
    } else if (!validateEmail(email)) {
        alert("Por favor, ingresa un correo electrónico válido.");
        event.preventDefault();
    }
});

// Validación del formulario de registro de cuenta
document.getElementById("crear-cuenta").addEventListener("submit", function(event) {
    var nombre = document.getElementById("nombre").value;
    var emailRegistro = document.getElementById("email-registro").value;
    var passwordRegistro = document.getElementById("password-registro").value;
    var confirmPassword = document.getElementById("confirm-password").value;

    if (nombre === "" || emailRegistro === "" || passwordRegistro === "" || confirmPassword === "") {
        alert("Todos los campos son obligatorios");
        event.preventDefault();
    } else if (!validateEmail(emailRegistro)) {
        alert("Por favor, ingresa un correo electrónico válido.");
        event.preventDefault();
    } else if (passwordRegistro !== confirmPassword) {
        alert("Las contraseñas no coinciden.");
        event.preventDefault();
    }
});

// Función para validar el formato del correo electrónico
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/; // Expresión regular para validar el correo
    return re.test(email);
}
