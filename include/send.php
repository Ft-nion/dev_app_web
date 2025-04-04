<?php
session_start();
require("conn.php");

if (isset($_POST['send'])) {
    $errors = [];

    if (strlen($_POST['name']) < 1) {
        $errors['name'] = "El nombre es obligatorio.";
    }
    if (strlen($_POST['phone']) < 1) {
        $errors['phone'] = "El teléfono es obligatorio.";
    }
    if (strlen($_POST['email']) < 1) {
        $errors['email'] = "El email es obligatorio.";
    }
    if (strlen($_POST['password']) < 1) {
        $errors['password'] = "La contraseña es obligatoria.";
    }

    if (empty($errors)) {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Encriptar la contraseña

        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registrado con éxito.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Ocurrió un error.";
            $_SESSION['message_type'] = "error";
        }

        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
    }

    header("Location: ../forms/form-register.php");
    exit();
}

$conn->close();
?>