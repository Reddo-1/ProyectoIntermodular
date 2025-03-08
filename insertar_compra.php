<?php
include "conexion.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user_id'];
    $referencia = $_POST['referencia'];

    if (isset($user_id) && isset($referencia)) {
        // Insertar los datos en la base de datos
        $stmt = $conn->prepare("INSERT INTO compras (user_id, referencia) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $referencia);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false]);
    }
}

$conn->close();
?>
