<?php
include('db.php');

$conn = conn();

$id_user = obtenerId();
$id_prd = $_POST['product_id'];
if($id_user){
    $sql = "SELECT ID FROM carrito WHERE ID_User = ? AND boolStatus = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $carrito = $result->fetch_assoc();

    if ($carrito) {
        $id_carrito = $carrito['ID'];
    } else {
        // No hay carrito activo, crear uno nuevo
        $sql = "INSERT INTO carrito (ID_User, boolStatus) VALUES (?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $id_carrito = $stmt->insert_id; // Obtener el ID del nuevo carrito
    }

    // Insertar el producto en el carrito_prd
    $sql = "INSERT INTO carrito_prd (ID_Carrito, ID_Prd, cantidad) VALUES (?, ?, '1')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_carrito, $id_prd);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../Views/PaginaInicio.html");
    } else {
        echo "Error al agregar el producto al carrito.";
    }
}else{
    header("Location: ../Views/LoginVentanas/Login.html");
}



$conn->close();
?>
