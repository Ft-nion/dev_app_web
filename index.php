<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está logueado
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$role_id = $isLoggedIn ? $_SESSION['role_id'] : null; // Obtener el rol si está logueado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas de Pollo</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <h1>Recetas de cocina</h1>
          <!-- Mostrar el correo del usuario y el botón de cerrar sesión -->
        <?php if ($isLoggedIn): ?>
            <h3>Bienvenido, <?php echo htmlspecialchars($_SESSION['email']); ?></h3>
        <?php endif; ?>
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
                <?php if ($isLoggedIn): ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                <?php endif; ?>
            </ul>
            <div class="nav-buttons">
                <?php if ($isLoggedIn): ?>
                    <button onclick="window.location.href='./include/close.php'">Cerrar sesión</button>
                <?php else: ?>
                    <!-- Mostrar los botones de registro e inicio de sesión -->
                    <button onclick="window.location.href='./forms/form-register.php'">Registrarse</button>
                    <button onclick="window.location.href='./forms/login.php'">Ingresar</button>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main>
        <section id="recipe-content">
            <div class="recipe">
                <a href="recipes/mango-habanero-wings.html">
                    <img src="assets/mango_hab.jpg" alt="Alitas Mango Habanero">
                    <h3 class="recipe-title">Alitas Mango Habanero</h3>
                </a>
            </div>
            <div class="recipe">
                <a href="recipes/habanero.html">
                    <img src="assets/habanero.jpg" alt="Alitas Habanero">
                    <h3 class="recipe-title">Alitas Habanero</h3>
                </a>
            </div>
            <div class="recipe">
                <a href="recipes/bbq.html">
                    <img src="assets/bbq.jpg" alt="Alitas BBQ">
                    <h3 class="recipe-title">Alitas BBQ</h3>
                </a>
            </div>
            <div class="recipe">
                <a href="recipes/garlic-parmesan.html">
                    <img src="assets/parmesano.jpg" alt="Pollo Ajo y Parmesano">
                    <h3 class="recipe-title">Alitas Ajo Parmesano</h3>
                </a>
            </div>
            <div class="recipe">
                <a href="recipes/fried-chicken.html">
                    <img src="assets/pollo-frito.jpg" alt="Pollo frito">
                    <h3 class="recipe-title">Pollo frito</h3>
                </a>
            </div>
        </section>
    </main>
    <footer>
        <section class="ul-container">
            <ul class="footer-list">
                <li><a href="./forms/contac.html">Contacto</a></li>
            </ul>
        </section>
    </footer>
    <script src="scripts/main.js"></script>
</body>
</html>