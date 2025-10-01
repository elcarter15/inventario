<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM equipos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: inventory.php");
    } else {
        echo "Error eliminando equipo: " . $conn->error;
    }
}

$conn->close();
?>