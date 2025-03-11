<?php
// filepath: /home/ft-nion/Documentos/desarrollo_web/chicken-recipes/include/conn.php

$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "db_chicken";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>