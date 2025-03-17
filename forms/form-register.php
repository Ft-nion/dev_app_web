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
            </ul>
            <div class="nav-buttons">
                <button onclick="window.location.href='login.php'">Ingresar</button>
            </div>
        </nav>
    </header>    
    <form class="form" method="post">
            <h2 class="form-tittle">Formulario de registro</h2>        
            <div class="form-container">
                <div class="form-grup">
                    <input type="text" id="name" name="name" class="form-input" placeholder="">
                    <label for="name" class="form-label1">Nombre:</label>
                    <span class="form-line"></span>
                </div>
            </div>
            <div class="form-container">
                <div class="form-grup">
                    <input type="phone" id="phone"  name="phone" class="form-input" placeholder="">
                    <label for="phone" class="form-label1">Telefono:</label>
                    <span class="form-line"></span>
                </div>
            </div>
            <div class="form-container">
                <div class="form-grup">
                    <input type="email" id="email"  name="email" class="form-input" placeholder="">
                    <label for="email" class="form-label1">Email:</label>
                    <span class="form-line"></span>
                </div>
            </div>
            <div class="form-container">
                <div class="form-grup">
                    <input type="password" id="password"  name="password" class="form-input" placeholder="">
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