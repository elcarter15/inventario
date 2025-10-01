<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('imagenes/update_pass.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="login-container">
        <h2 class="text-center">Registro de Usuario</h2>
        
        <?php
        if (isset($_GET['message'])) {
            echo "<p class='message'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        ?>
        
        <form action="register_user.php" method="post">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="pregunta_seguridad">Pregunta de Seguridad:</label>
                <select class="form-control" id="pregunta_seguridad" name="pregunta_seguridad" required>
                    <option value="mascota">¿Cuál es el nombre de tu primera mascota?</option>
                    <option value="ciudad">¿En qué ciudad naciste?</option>
                    <option value="escuela">¿Cuál fue el nombre de tu escuela primaria?</option>
                    <option value="herue">¿Cuál fue tu superheroe favorito de infancia?</option>
                    <option value="color">¿Cuál es tu color favorito?</option>
            </div>
            <div class="form-group">
                <label for="respuesta_seguridad">Respuesta de Seguridad:</label>
                <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>
        
        <p class="text-center">¿Ya tienes cuenta? <a href="index.php">Iniciar sesión</a></p>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>