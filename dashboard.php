<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: forms/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/dashboard.css">
    <title>Dashboard</title>
    <script>
        function mostrarFechaHora() {
            const fecha = new Date();
            const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const fechaFormateada = fecha.toLocaleDateString('es-ES', opcionesFecha);
            const horaFormateada = fecha.toLocaleTimeString('es-ES');
            document.getElementById('fecha-hora').innerText = `Hoy es ${fechaFormateada} y la hora actual es ${horaFormateada}.`;
        }

        setInterval(mostrarFechaHora, 1000); // Actualiza cada segundo
    </script>
</head>
<body onload="mostrarFechaHora()">

        <nav class="main-nav">
            <ul class="nav-list">
            </ul>
            <div class="nav-buttons">
                        <button onclick="window.location.href='./include/close.php'">Cerrar sesión</button>
            </div>
        </nav>

    <!-- Contenedor principal con módulos -->
    <main>
        <!-- Columna de módulos -->
        <div class="module-column">
            <div class="module">
                <h3><a href="dashboard.php">Panel</a></h3> 
            </div>
            <div class="module">
                <h3><a href="./modules/user/user.php">Usuarios</a></h3>
            </div>
            <div class="module">
                <h3>Módulo 3</h3>
                <p>Contenido del módulo 3.</p>
            </div>
        </div>

        <!-- Columna de contenido -->
        <div class="content-column">
            <h2>Hola, <?php echo $_SESSION['email']; ?>!</h2>
            <p>Este es tu panel de control.</p>
            <p id="fecha-hora"></p>
        </div>
    </main>
</body>
</html>