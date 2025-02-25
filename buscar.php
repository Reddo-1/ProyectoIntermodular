<?php
include "conexion.php";

if (isset($_GET['query'])) {
    $search = $conn->real_escape_string($_GET['query']);

    $sql = "SELECT p.id_producto, p.nombre, p.precio, p.imagen , m.nombre as nombreMarca FROM productos p 
    Inner join marcas m on p.id_marca_producto = m.id_marca
    WHERE p.nombre LIKE '%$search%' or m.nombre LIKE '%$search%' 
    LIMIT 10
    ";
    $result = $conn->query($sql);

    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    echo json_encode($productos);
}
$conn->close();
?>
