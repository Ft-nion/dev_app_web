<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forms.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Formulario</title>
</head>
<body>
    <header style="height: 200px;">
        <h1>Recetas de cocina</h1>
        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="../index.html">Home</a></li>
            </ul>
        </nav>
    </header>    
    <form class="form">
            <h2 class="form-tittle">Inciar session</h2>
            <p class="form-paragrath">Aun no tienes cuenta, da click <a href="./form-register.html" class="form-link">aquí</a></p>
        
            <div class="form-container">
                <div class="form-grup">
                    <input type="email" id="email" class="form-input" placeholder="">
                    <label for="email" class="form-label1">Email:</label>
                    <span class="form-line"></span>
                </div>
            </div>
            <div class="form-container">
                <div class="form-grup">
                    <input type="password" id="password" class="form-input" placeholder="">
                    <label for="password" class="form-label1">Contraseña:</label>
                    <span class="form-line"></span>
                </div>
            <input type="submit" name="send" class="form-submit" value="Enter">
            </div>
    </form>

    
    <?php
    include("../include/send.php");
    ?>


</body>
</html>