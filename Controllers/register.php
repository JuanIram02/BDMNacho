<?php
include('db.php');

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['correo'];
    $username = $_POST['usuario'];
    $password = $_POST['contrasena'];
    $confirm_password = $_POST['confirmar_contrasena'];
    $birthdate = $_POST['fecha_nacimiento'];
    $sex = $_POST['sexo'];
    $profile_privacy = isset($_POST['perfil_privado']) ? 1 : 0;
    $account_type = $_POST['tipo_cuenta'];

    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit; 
    }

    $check_email_query = "SELECT * FROM usuario WHERE correo = '$email'";
    $email_result = $conn->query($check_email_query);
    if ($email_result->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
        exit; 
    }

    $check_username_query = "SELECT * FROM usuario WHERE usernm = '$username'";
    $username_result = $conn->query($check_username_query);
    if ($username_result->num_rows > 0) {
        echo "El nombre de usuario ya está en uso.";
        exit; 
    }

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $imagen_temp = $_FILES['img']['tmp_name'];
        $imagen_data = file_get_contents($imagen_temp);
        $imagen_base64 = base64_encode($imagen_data); // Codificar la imagen en base64

        // Insertar usuario en la base de datos con la imagen como BLOB
        $insert_query = "INSERT INTO usuario (correo, usernm, Contra, feNacimiento, sexo, boolPublico, Rol, 'created-at', imagen) 
                         VALUES ('$email', '$username', '$password', '$birthdate', '$sex', '$profile_privacy', '$account_type', 'today()', '$imagen_base64')";
        
        if ($conn->query($insert_query) === TRUE) {
            session_start();
            $_SESSION['email'] = $email;
            echo "success";
        } else {
            http_response_code(500); 
            echo "Error al registrar usuario: " . $conn->error;
        }
    } else {
        http_response_code(400); 
        echo "Error al procesar la imagen de perfil. Código de error: " . $_FILES['img']['error'];
    }
} else {
    http_response_code(400); 
    echo "Acceso denegado.";
}

$conn->close();
?>
