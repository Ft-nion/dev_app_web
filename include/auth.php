<?php
session_start();
require("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['auth'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT id, email, name, password, role_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $email, $name, $hashed_password, $role_id);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['role_id'] = $role_id; // Cambiado a 'role_id' para que coincida con la base de datos

            // Redirigir al dashboard
            header("Location: ../index.php");
            exit;
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message = "No se encontró una cuenta con ese correo electrónico.";
    }

    $stmt->close();
    $conn->close();
}
?>
