<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../index.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}

require '../../include/conn.php'; // Asegúrate de que la conexión esté configurada correctamente

// Manejar la creación del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $roleId = $_POST['role_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Consulta para insertar un nuevo usuario
    $insertSql = "INSERT INTO users (name, phone, email, role_id, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("sssis", $name, $phone, $email, $roleId, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario creado correctamente.'); window.location.href='user.php';</script>";
    } else {
        echo "<script>alert('Error al crear el usuario.');</script>";
    }
}

// Consulta para obtener los roles
$rolesSql = "SELECT id, name FROM roles";
$rolesResult = $conn->query($rolesSql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <link rel="stylesheet" href="../../styles/module.css">
</head>
<body>
    <nav class="main-nav">
        <ul class="nav-list">
        </ul>
        <div class="nav-buttons">
            <button onclick="window.location.href='../../include/close.php'">Cerrar sesión</button>
        </div>
    </nav>

    <main>
        <!-- Columna de módulos -->
        <div class="module-column">
            <div class="module">
                <h3><a href="../../dashboard.php">Panel</a></h3>
            </div>
            <div class="module">
                <h3><a href="user.php">Usuarios</a></h3>
            </div>
            <div class="module">
                <h3>Módulo 3</h3>
                <p>Contenido del módulo 3.</p>
            </div>
        </div>

        <!-- Columna de contenido -->
        <div class="content-column">
            <h1>Crear Usuario</h1>
            <form method="POST" action="">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="phone">Teléfono:</label>
                <input type="text" id="phone" name="phone" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="role_id">Rol:</label>
                <select id="role_id" name="role_id" required>
                    <?php
                    if ($rolesResult->num_rows > 0) {
                        while ($role = $rolesResult->fetch_assoc()) {
                            echo "<option value='" . $role['id'] . "'>" . htmlspecialchars($role['name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay roles disponibles</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit" class="edit-button">Crear Usuario</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>