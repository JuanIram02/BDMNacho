<?php
include('db.php');

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $cotizable = isset($_POST['cotizable']) ? 1 : 0;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $id = obtenerId();
    
    // Verificar si la imagen se ha subido correctamente
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $imagen_temp = $_FILES['img']['tmp_name'];
        $imagen_data = file_get_contents($imagen_temp);
        $imagen_base64 = base64_encode($imagen_data); // Codificar la imagen en base64

        // Insertar producto en la base de datos con la imagen como BLOB
        $insert_query = "INSERT INTO `producto` (`Nombre`, `ID_User`, `ID_Cat`, `descrip`, `BoolVender`, `BoolStatus`, `precio`, `stock`, `feReg`, `feEdit`, `imagen`) 
                 VALUES ('$nombre', '$id', NULL, '$descripcion', '$cotizable', '1', '$precio', '$stock', CURDATE(), CURDATE(), '$imagen_base64')";
        if ($conn->query($insert_query) === TRUE) {
            echo "success";
        } else {
            echo "Error al crear producto: " . $conn->error;
        }
    } else {
        echo "Error al procesar la imagen de producto. Código de error: " . $_FILES['img']['error'];
    }
} else {
    echo "Acceso denegado.";
}

$conn->close();
?>