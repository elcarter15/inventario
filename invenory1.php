<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light" style="background-image: url('imagenes/horinzontal.png'); background-repeat: no-repeat; background-position: center; background-attachment: fixed;">

    <div class="container mt-5">
        <h2 class="text-center">Inventario de Equipos Electrónicos</h2>
        <a href="logout.php" class="btn btn-danger float-right mb-3">Cerrar sesión</a>
        
        <form action="add_equipment.php" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="form-group">
                <label for="año">Año:</label>
                <input type="number" class="form-control" id="año" name="año" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div class="form-group">
                <label for="serial">Serial:</label>
                <input type="text" class="form-control" id="serial" name="serial" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Equipo</button>
        </form>

        <h3>Equipos en Inventario</h3>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Tipo</th>
                    <th>Serial</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $sql = "SELECT * FROM equipos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['codigo']}</td>
                            <td>{$row['marca']}</td>
                            <td>{$row['modelo']}</td>
                            <td>{$row['año']}</td>
                            <td>{$row['tipo']}</td>
                            <td>{$row['serial']}</td>
                            <td><img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' width='100'></td>
                            <td>
                                <a href='edit_equipment.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='delete_equipment.php?id={$row['id']}' class='btn btn-danger btn-sm'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No hay equipos en el inventario.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>