<?php
include('db.php');

$conn = conn();

$id = obtenerId(); // Asume que la ID del usuario se pasa como parámetro en la URL, ej. buscar.php?id=1

// Preparar la consulta SQL
$search_query = $conn->prepare("SELECT * FROM `producto` WHERE `ID_User` = ?");
$search_query->bind_param("i", $id);

// Ejecutar la consulta
$search_query->execute();
$result = $search_query->get_result();

$productos = array();

if ($result->num_rows > 0) {
    // Recoger los productos encontrados en un array
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
} 
else{
    echo 'no products';
}

// Cerrar la declaración y la conexión
$search_query->close();
$conn->close();

echo json_encode($productos);
?>