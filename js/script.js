function validarFormulario() {
    var nombre = document.getElementById("nombre").value.trim();
    var email = document.getElementById("email").value.trim();
    var telefono = document.getElementById("telefono").value.trim();
    var mensaje = document.getElementById("mensaje").value.trim();
    var edad = document.getElementById("edad").value.trim();

    if (nombre === "" || email === "" || telefono === "" || mensaje === "" || edad === "") {
        alert("Por favor, completa todos los campos.");
        return false;
    }

    // Validación de formato de email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Por favor, ingresa un email válido.");
        return false;
    }

    // Validación de edad
    if (edad < 0 || edad > 120) {
        alert("Por favor, ingresa una edad válida.");
        return false;
    }

    // Redirigir a la página de gracias
    window.location.href = "gracias.php";
    return false; // Para evitar el envío del formulario
}