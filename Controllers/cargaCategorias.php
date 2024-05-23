<?php
    include('db.php');

    $conn = conn();

    $sql = "SELECT * FROM cat";

    $resultado = $conn->query($sql);

    $datos_perfil = array();

    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $datos_perfil[] = $row;
        }
        echo json_encode($datos_perfil);
    } else {
        echo json_encode(array()); 
    }

    $conn->close();

?>