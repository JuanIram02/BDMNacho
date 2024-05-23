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

}

// Cerrar conexión
$conn->close();
echo json_encode($carrito_id);
?>