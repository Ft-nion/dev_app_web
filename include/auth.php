<?php
session_start();
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['auth'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;

            // Redirigir al dashboard
            header("Location: ../dashboard.php");
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
