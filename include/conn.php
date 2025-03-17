<?php
$servername = "mnz.domcloud.co";
$username = "front-escape-cuk";
$password = "-x_2Dzb7AHN46n1Et-";
$dbname = "front_escape_cuk_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>