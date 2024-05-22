<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al usuario a la página de inicio de sesión o a la página principal
header("Location: ../Views/LoginVentanas/Login.html");
exit();
?>