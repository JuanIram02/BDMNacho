<?php
include('db.php');

session_start(); 

if (isset($_SESSION['email'])) {

    $correo = $_SESSION['email'];

    $conn = conn();

    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $datos_perfil = $resultado->fetch_assoc();
        echo json_encode($datos_perfil);
    } else {
        echo json_encode(array()); 
    }

    $conn->close();
} else {
    echo json_encode(array()); 
}
?>