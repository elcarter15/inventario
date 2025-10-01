<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Pregunta de Seguridad</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light" style="background-image: url('imagenes/register.png'); background-size: cover; background-attachment: fixed;">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Verificar Pregunta de Seguridad</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $username = $_POST['username'];

                            // Obtener la pregunta de seguridad del usuario
                            $sql = "SELECT pregunta_seguridad FROM usuarios WHERE username=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $pregunta_seguridad = $row['pregunta_seguridad'];

                                echo "<form action='reset_password.php' method='post'>
                                        <input type='hidden' name='username' value='$username'>
                                        <div class='form-group'>
                                            <label for='respuesta_seguridad'>Pregunta de Seguridad: $pregunta_seguridad</label>
                                            <input type='text' id='respuesta_seguridad' name='respuesta_seguridad' class='form-control' required>
                                        </div>
                                        <button type='submit' class='btn btn-primary btn-block'>Verificar</button>
                                      </form>";
                            } else {
                                echo "<p class='text-danger text-center'>Usuario no encontrado.</p>";
                            }
                        } else {
                            echo "<p class='text-danger text-center'>Usuario no encontrado. Vuelve a intentarlo.</p>";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
