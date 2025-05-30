<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../index.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}

require '../../include/conn.php'; // Asegúrate de que la conexión esté configurada correctamente

// Verificar si se recibió el ID del usuario
if (!isset($_GET['id'])) {
    echo "<script>alert('ID de usuario no válido.'); window.location.href='user.php';</script>";
    exit;
}

$userId = intval($_GET['id']); // Sanitizar el ID recibido

// Verificar permisos: si no es administrador y el ID no coincide con el usuario logueado
if ($_SESSION['role_id'] != 1 && $_SESSION['id'] != $userId) {
    echo "<script>alert('No tienes permiso para editar este usuario.'); window.location.href='user.php';</script>";
    exit();
}

// Obtener los datos actuales del usuario
$sql = "SELECT id, name, phone, email, role_id FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Usuario no encontrado.'); window.location.href='user.php';</script>";
    exit;
}

$user = $result->fetch_assoc();

// Manejar la actualización del usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? $user['name'];
    $phone = $_POST['phone'] ?? $user['phone'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Construir la consulta de actualización
    $updateSql = "UPDATE users SET name = ?, phone = ?";
    $params = [$name, $phone];
    $types = "ss";

    if ($password) {
        $updateSql .= ", password = ?";
        $params[] = $password;
        $types .= "s";
    }

    // Solo permitir que los administradores actualicen el rol y el email
    if ($_SESSION['role_id'] == 1) {
        $email = $_POST['email'] ?? $user['email'];
        $roleId = $_POST['role_id'] ?? $user['role_id'];
        $updateSql .= ", email = ?, role_id = ?";
        $params[] = $email;
        $params[] = $roleId;
        $types .= "si";
    }

    $updateSql .= " WHERE id = ?";
    $params[] = $userId;
    $types .= "i";

    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario actualizado correctamente.'); window.location.href='user.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el usuario.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <link rel="stylesheet" href="../../styles/module.css">
</head>
<body>

<header>
        <h1>Recetas de cocina</h1>
        <nav class="main-nav">
            <ul class="nav-list">
            <li><a href="../../index.php">Home</a></li>
            <li><a href="../../dashboard.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>

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
            <h1>Editar Usuario</h1>
            <form method="POST" action="">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                <br>
                <label for="phone">Teléfono:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                <br>
                <?php if ($_SESSION['role_id'] == 1): ?>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    <br>
                    <label for="role_id">Rol:</label>
                    <select id="role_id" name="role_id">
                        <option value="1" <?php echo $user['role_id'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                        <option value="2" <?php echo $user['role_id'] == 2 ? 'selected' : ''; ?>>Usuario</option>
                    </select>
                    <br>
                <?php endif; ?>
                <label for="password">Nueva Contraseña (opcional):</label>
                <input type="password" id="password" name="password">
                <br>
                <button type="submit" class="edit-button">Actualizar Usuario</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>

