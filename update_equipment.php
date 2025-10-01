<?php 
include 'db.php'; 

if (isset($_GET['id'])) { 
    $id = $_GET['id']; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $codigo = $_POST['código']; 
        $marca = $_POST['marca']; 
        $modelo = $_POST['modelo']; 
        $año = $_POST['año']; 
        $tipo = $_POST['tipo']; 
        $serial = $_POST['serial']; 

        if ($_FILES['imagen']['name'] != '') { 
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']); 
            $sql = "UPDATE equipos SET código=?, marca=?, modelo=?, año=?, tipo=?, serial=?, imagen=? WHERE id=?"; 
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("sssssssi", $codigo, $marca, $modelo, $año, $tipo, $serial, $imagen, $id); 
        } else { 
            $sql = "UPDATE equipos SET código=?, marca=?, modelo=?, año=?, tipo=?, serial=? WHERE id=?"; 
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("ssssssi", $codigo, $marca, $modelo, $año, $tipo, $serial, $id); 
        } 

        $stmt->execute(); 
        header("Location: inventory.php"); 
    } 
} 

$conn->close(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Equipo</title>
</head>
<body>
<div class="container mt-5">
    <h2>Editar Equipo</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" class="form-control" id="codigo" name="código" required>
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required>
        </div>
        <div class="form-group">
            <label for="ano">Año</label>
            <input type="text" class="form-control" id="ano" name="año" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>
        <div class="form-group">
            <label for="serial">Serial</label>
            <input type="text" class="form-control" id="serial" name="serial" required>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" class="form-control-file" id="imagen" name="imagen">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>