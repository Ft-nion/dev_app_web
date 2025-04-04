<?php
session_start();
require '../../include/conn.php'; // Asegúrate de que la conexión esté configurada correctamente

// Verificar si se recibió el ID del usuario a eliminar
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Sanitizar el ID recibido

    // Verificar si el usuario logueado es el mismo que se intenta eliminar
    if ($_SESSION['id'] == $userId) {
        echo "<script>alert('No puedes eliminar el usuario con el que estás logueado.'); window.location.href='user.php';</script>";
        exit;
    }

    // Consulta para eliminar el usuario
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario eliminado correctamente.'); window.location.href='user.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el usuario.'); window.location.href='user.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID de usuario no válido.'); window.location.href='user.php';</script>";
}

$conn->close();
?>