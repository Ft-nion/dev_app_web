<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forms.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Formulario</title>
</head>
<body>
    <header style="height: 200px;">
        <h1>Recetas de cocina</h1>
        <nav class="main-nav">
        <li><a href="../index.php">Home</a></li>
        </nav>
    </header>    
    <form class="form" method="post">
        <h2 class="form-tittle">Iniciar sesión</h2>
        <p class="form-paragraph">Aún no tienes cuenta, da click <a href="./form-register.php" class="form-link">aquí</a></p>
        
        <div class="form-container">
            <div class="form-grup">
                <input type="email" name="email" id="email" class="form-input" placeholder="">
                <label for="email" class="form-label1">Email:</label>
                <span class="form-line"></span>
            </div>
        </div>
        <div class="form-container">
            <div class="form-grup">
                <input type="password" name="password" id="password" class="form-input" placeholder="">
                <label for="password" class="form-label1">Contraseña:</label>
                <span class="form-line"></span>
            </div>
            <input type="submit" name="auth" class="form-submit" value="Enter">
        </div>
    </form>
    <?php
    include("../include/auth.php");
    ?>
</body>
</html>