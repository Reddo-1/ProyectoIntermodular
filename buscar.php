<?php
include "conexion.php";

if (isset($_GET['query'])) {
    $search = $conn->real_escape_string($_GET['query']);

    $sql = "SELECT id_producto, nombre, precio, imagen FROM productos WHERE nombre LIKE '%$search%' LIMIT 10";
    $result = $conn->query($sql);

    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    echo json_encode($productos);
}
$conn->close();
?>
