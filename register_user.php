<?php
session_start();
include 'db.php';

$message = ''; // Variable para almacenar mensajes de error o éxito
$stmtInsert = null; // Inicializar la variable $stmtInsert

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $pregunta_seguridad = $_POST['pregunta_seguridad'];
    $respuesta_seguridad = password_hash(trim($_POST['respuesta_seguridad']), PASSWORD_DEFAULT);

    // Verificar si el nombre de usuario ya existe
    $sqlCheck = "SELECT * FROM usuarios WHERE username=?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $username);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $message = "El nombre de usuario ya está en uso. Elige otro.";
    } else {
        // Hash de la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar nuevo usuario
        $sqlInsert = "INSERT INTO usuarios (username, password, pregunta_seguridad, respuesta_seguridad) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);

        if ($stmtInsert) { // Verificar si la preparación fue exitosa
            $stmtInsert->bind_param("ssss", $username, $passwordHash, $pregunta_seguridad, $respuesta_seguridad);

            if ($stmtInsert->execute()) {
                $_SESSION['user'] = $username; // Inicia sesión automáticamente si lo deseas
                $message = "Registro exitoso. Puedes.";
            } else {
                $message = "Error al registrar el usuario: " . $stmtInsert->error;
            }
        } else {
            $message = "Error al preparar la consulta: " . $conn->error;
        }
    }

    // Cerrar las consultas
    $stmtCheck->close();
    if ($stmtInsert) {
        $stmtInsert->close(); // Cerrar $stmtInsert solo si fue definido
    }

    // Redirigir a la página de registro con un mensaje
    header("Location: register.php?message=" . urlencode($message));
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('imagenes/Registro.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Registro de Usuario</h2>

        <?php if ($message): ?>
            <div class="error-box">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="pregunta_seguridad">Pregunta de Seguridad:</label>
                <input type="text" class="form-control" id="pregunta_seguridad" name="pregunta_seguridad" required>
            </div>
            <div class="form-group">
                <label for="respuesta_seguridad">Respuesta de Seguridad:</label>
                <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>

        <p class="text-center">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>