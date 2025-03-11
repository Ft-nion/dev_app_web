<?php
// filepath: /home/ft-nion/Documentos/desarrollo_web/chicken-recipes/include/conn.php

$servername = "mnz.domcloud.co";
$username = "ft-nion";
$password = "3X4b-s8UgC7g4iFG_)";
$dbname = "ft_nion_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>