<?php
include('db.php');

$conn = conn();

$id = obtenerId(); // Asume que la ID del usuario se pasa como parámetro en la URL, ej. buscar.php?id=1

// Preparar la consulta SQL
$search_query = $conn->prepare("SELECT ID, Nombre, descrip, precio, imagen, stock FROM `producto`");

// Ejecutar la consulta
$search_query->execute();

// Vincular las columnas de resultado
$search_query->bind_result($id, $nombre, $descrip, $precio, $imagen, $stock);

$productos = array();

// Recorrer los resultados
while ($search_query->fetch()) {
    $producto = array(
        'ID' => $id,
        'Nombre' => $nombre,
        'descrip' => $descrip,
        'precio' => $precio,
        'imagen' => $imagen,
        'stock' => $stock,
    );
    $productos[] = $producto;
}

if ($search_query->error) {
    echo "Error: " . $search_query->error;
}
// Cerrar la declaración y la conexión
$search_query->close();
$conn->close();

echo json_encode($productos);
?>
