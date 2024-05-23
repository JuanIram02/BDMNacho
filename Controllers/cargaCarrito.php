<?php
include("db.php");

$conn = conn();

$usuario_id = obtenerId(); 

$sql = "SELECT id FROM carrito WHERE ID_User = ? AND boolStatus = 1 LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtener la ID del carrito
    $row = $result->fetch_assoc();
    $carrito_id = $row['id'];

    // Obtener los productos en el carrito
    $sql = "
        SELECT p.id, p.imagen, p.Nombre, p.precio, cp.cantidad 
        FROM carrito_prd cp
        JOIN producto p ON cp.ID_Prd = p.ID
        WHERE cp.ID_Carrito = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carrito_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $productos = array();

        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    } else {
        echo "No se encontraron productos en el carrito.";
    }
} else {
    echo "No se encontró un carrito activo para el usuario.";
}

// Cerrar conexión
$conn->close();
echo json_encode($productos);
?>
