<?php
// filepath: /home/ft-nion/Documentos/desarrollo_web/chicken-recipes/include/send.php

include("conn.php");

if (isset($_POST['send'])) {
    if (
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['phone']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1
    ) {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Encriptar la contraseña

        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $password);

      
        if ($stmt->execute()) {
            echo '<h3 class="success">Registrado con éxito.</h3>';
        } else {
            echo '<h3 class="error">Ocurrió un error</h3>';
        }

        $stmt->close();
    } else {
        echo '<h3 class="error">Llena todos los campos</h3>';
    }
}

$conn->close();
?>