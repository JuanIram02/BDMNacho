<?php
include('db.php');

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['id'];
    $username = $_POST['usuario'];
    $password = $_POST['contrasena'];
    $confirm_password = $_POST['confirmar_contrasena'];
    $birthdate = $_POST['fecha_nacimiento'];
    $sex = ($_POST['sexo'] == 0) ? "M" : "F";
    $profile_privacy = isset($_POST['perfil_privado']) ? 1 : 0;

    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit; 
    }

    $check_username_query = "SELECT * FROM usuario WHERE usernm = '$username' AND ID != '$ID'";
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
        $edit_query = "UPDATE usuario SET usernm = '$username', Contra = '$password', feNacimiento = '$birthdate', sexo = '$sex', boolPublico = '$profile_privacy', imagen = '$imagen_base64'  
            WHERE ID = '$ID'";
        
        if ($conn->query($edit_query) === TRUE) {
            echo "success";
        } else {
            http_response_code(500); 
            echo "Error al registrar usuario: " . $conn->error;
        }
    } 

    if ($_FILES['img']['error'] === UPLOAD_ERR_NO_FILE) {
        $edit_query = "UPDATE usuario SET usernm = '$username', Contra = '$password', feNacimiento = '$birthdate', sexo = '$sex', boolPublico = '$profile_privacy'  
            WHERE ID = '$ID'";
        
        if ($conn->query($edit_query) === TRUE) {
            echo "success";
        } else {
            http_response_code(500); 
            echo "Error al registrar usuario: " . $conn->error;
        }
    }
} else {
    http_response_code(400); 
    echo "Acceso denegado.";
}

$conn->close();
?>
