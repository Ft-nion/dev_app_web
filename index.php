<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas de Pollo</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/recipes.css">
</head>
<body>
    <header>
        <h1>Recetas de cocina</h1>
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
            </ul>
            <div class="nav-buttons">
                <button onclick="window.location.href='./forms/form-register.php'">Registrarse</button>
                <button onclick="window.location.href='./forms/login.php'">Ingresar</button>
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
    <div>
        <section class="ul-container">
            <ul class="footer-list">
            <li><a href="./forms/contac.html">Contacto</a></li>
            </ul>
        </section>
    </div>
   
    <script src="scripts/main.js"></script>
</body>
</html>