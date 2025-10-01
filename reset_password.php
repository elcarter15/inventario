<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('imagenes/reset_pass.png');
            background-size: cover;
            background-attachment: fixed;
        }
        
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        <h2 class="text-center">Actualizar Contraseña</h2>
        <?php
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $respuesta_seguridad = $_POST['respuesta_seguridad'];

            // Verificar la respuesta de seguridad
            $sql = "SELECT respuesta_seguridad FROM usuarios WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hash_respuesta = $row['respuesta_seguridad'];

                if (password_verify($respuesta_seguridad, $hash_respuesta)) {
                    echo "<form action='update_password.php' method='post'>
                            <input type='hidden' name='username' value='$username'>
                            <div class='form-group'>
                                <label for='password'>Nueva Contraseña:</label>
                                <input type='password' class='form-control' id='password' name='password' required>
                            </div>
                            <button type='submit' class='btn btn-primary btn-block'>Actualizar Contraseña</button>
                          </form>";
                } else {
                    echo "<p class='message'>Respuesta de seguridad incorrecta.</p>";
                }
            } else {
                echo "<p class='message'>Usuario no encontrado.</p>";
            }
        }
        $conn->close();
        ?>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>