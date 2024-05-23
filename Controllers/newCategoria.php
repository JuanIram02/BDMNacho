<?php
include('db.php');

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $id = obtenerId();

        // Insertar producto en la base de datos con la imagen como BLOB
        $insert_query = "INSERT INTO `cat` (`Nombre`, `ID_User`) 
                 VALUES ('$nombre', '$id')";
        if ($conn->query($insert_query) === TRUE) {
            echo "success";
        } else {
            echo "Error al crear producto: " . $conn->error;
        }

} else {
    echo "Acceso denegado.";
}

$conn->close();
?>