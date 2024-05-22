<?php

include('db.php');

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE correo = '$username' AND contra = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['email'] = $username;
        echo "success";
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    echo "Acceso denegado.";
}

$conn->close();
?>