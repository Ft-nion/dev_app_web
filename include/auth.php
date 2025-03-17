<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;

            // Redirigir al index
            header("Location: ../index.php");
            exit;
        } else {
            $error_message = "Contraseña incorrecta.";
        }
    } else {
        $error_message = "No se encontró una cuenta con ese correo electrónico.";
    }

    $stmt->close();
    $conn->close();
}
?>

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
            <ul class="nav-list">
                <li><a href="../index.php">Home</a></li>
            </ul>
        </nav>
    </header>    
    <form class="form" method="POST" action="auth.php">
        <h2 class="form-tittle">Iniciar sesión</h2>
        <p class="form-paragraph">Aún no tienes cuenta, da click <a href="./form-register.php" class="form-link">aquí</a></p>
        
        <?php
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
        
        <div class="form-container">
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-input" placeholder="">
                <label for="email" class="form-label1">Email:</label>
                <span class="form-line"></span>
            </div>
        </div>
        <div class="form-container">
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-input" placeholder="">
                <label for="password" class="form-label1">Contraseña:</label>
                <span class="form-line"></span>
            </div>
            <input type="submit" name="send" class="form-submit" value="Enter">
        </div>
    </form>
</body>
</html>