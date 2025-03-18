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
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/recipes.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Dashboard</h1>
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
            </ul>
            <div class="nav-buttons">
            <button onclick="window.location.href='./include/close.php'">Cerrar sesión</button>
            </div>
        </nav>
    </header>
    <main>
        <h2>Hola, <?php echo $_SESSION['email']; ?>!</h2>
        <p>Este es tu panel de control.</p>
        <!-- Aquí puedes agregar más contenido del dashboard -->
    </main>
</body>
</html>