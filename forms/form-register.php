<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forms.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Formulario</title>
    <style>
        .message {
            font-size: 1.2em;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            color: green;
            border: 2px solid green;
        }
        .error {
            color: red;
            border: 2px solid red;
        }
        .field-error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header style="height: 200px;">
        <h1>Recetas de cocina</h1>
        <nav class="main-nav">
            <ul class="nav-list">
            <li><a href="../index.php">Home</a></li>
            </ul>
            <div class="nav-buttons">
                <button onclick="window.location.href='login.php'">Ingresar</button>
            </div>
        </nav>
    </header>    
    <form class="form" method="post" action="../include/send.php">
        <h2 class="form-tittle">Formulario de registro</h2>        

        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo '<p class="message ' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <div class="form-container">
            <div class="form-grup">
                <input type="text" id="name" name="name" class="form-input" placeholder="">
                <label for="name" class="form-label1">Nombre:</label>
                <span class="form-line"></span>
                <?php
                if (isset($_SESSION['errors']['name'])) {
                    echo '<span class="field-error">' . $_SESSION['errors']['name'] . '</span>';
                }
                ?>
            </div>
        </div>
        <div class="form-container">
            <div class="form-grup">
                <input type="text" id="phone" name="phone" class="form-input" placeholder="">
                <label for="phone" class="form-label1">Teléfono:</label>
                <span class="form-line"></span>
                <?php
                if (isset($_SESSION['errors']['phone'])) {
                    echo '<span class="field-error">' . $_SESSION['errors']['phone'] . '</span>';
                }
                ?>
            </div>
        </div>
        <div class="form-container">
            <div class="form-grup">
                <input type="email" id="email" name="email" class="form-input" placeholder="">
                <label for="email" class="form-label1">Email:</label>
                <span class="form-line"></span>
                <?php
                if (isset($_SESSION['errors']['email'])) {
                    echo '<span class="field-error">' . $_SESSION['errors']['email'] . '</span>';
                }
                ?>
            </div>
        </div>
        <div class="form-container">
            <div class="form-grup">
                <input type="password" id="password" name="password" class="form-input" placeholder="">
                <label for="password" class="form-label1">Contraseña:</label>
                <span class="form-line"></span>
                <?php
                if (isset($_SESSION['errors']['password'])) {
                    echo '<span class="field-error">' . $_SESSION['errors']['password'] . '</span>';
                }
                ?>
            </div> 
            <input type="submit" name="send" class="form-submit" value="Enter">
        </div>
    </form>
    <?php
    unset($_SESSION['errors']);
    ?>
</body>
</html>