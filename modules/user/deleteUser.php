<?php
session_start();
require '../../include/conn.php'; // Asegúrate de que la conexión esté configurada correctamente

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../index.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}

// Verificar si el usuario tiene permisos de administrador
if ($_SESSION['role_id'] != 1) {
    echo "<script>alert('No tienes permiso para acceder a esta página.'); window.location.href='user.php';</script>";
    exit();
}

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