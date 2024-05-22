<?php
// Función para conectar a la base de datos
function conn() {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdm1";

    // Crear conexión utilizando MySQLi
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    return $conn;
}

function obtenerId() {
    session_start(); 

    if (isset($_SESSION['email'])) {
        $correo = $_SESSION['email'];

        $conn = conn();
        $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $datos_perfil = $resultado->fetch_assoc();
            return $datos_perfil["id"];
        } else {
            echo "error";
        }
    }
}
?>

