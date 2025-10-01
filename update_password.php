<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('imagenes/update_pass.png');
            background-size: cover;
            background-attachment: fixed;
        }
        .card {
            margin-top: 100px;
            opacity: 0.9; /* Agrega un poco de transparencia */
        }
    </style>
</head>
<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Actualizar Contraseña</h2>
                        <form method="POST">
                            <div class="form-group">
                                <label for="username">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Actualizar Contraseña</button>
                        </form>
                        <?php
                        include 'db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $username = $_POST['username'];
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                            $sql = "UPDATE usuarios SET password=? WHERE username=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $password, $username);

                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success text-center' role='alert'>Contraseña actualizada. Puedes <a href='index.php'>iniciar sesión</a>.</div>";
                            } else {
                                echo "<div class='alert alert-danger text-center' role='alert'>Error al actualizar la contraseña: " . $stmt->error . "</div>";
                            }

                            $stmt->close();
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>