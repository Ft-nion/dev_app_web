<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../../index.php'); // Redirigir al inicio de sesión si no está autenticado
    exit();
}

// Verificar si el rol está definido en la sesión
if (!isset($_SESSION['role_id'])) {
    header('Location: ../../index.php'); // Redirigir si no hay rol definido
    exit();
}

require '../../include/conn.php'; // Asegúrate de que la ruta sea correcta

// Filtrar usuarios según el rol
if ($_SESSION['role_id'] == 1) {
    // Si es administrador, mostrar todos los usuarios
    $sql = "SELECT users.id, users.name, users.phone, users.email, users.password, roles.name AS role_name, users.created_at 
            FROM users 
            JOIN roles ON users.role_id = roles.id";
    $result = $conn->query($sql); // Ejecutar la consulta y obtener los resultados
    if (!$result) {
        die("Error en la consulta: " . $conn->error); // Manejar errores en la consulta
    }
} else {
    // Si no es administrador, mostrar solo su propio usuario
    $userId = $_SESSION['user_id']; // Asegúrate de que el ID del usuario esté almacenado en la sesión
    $sql = "SELECT users.id, users.name, users.phone, users.email, users.password, roles.name AS role_name, users.created_at 
            FROM users 
            JOIN roles ON users.role_id = roles.id
            WHERE users.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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
    
    <header>
        <h1>Recetas de cocina</h1>
        <nav class="main-nav">
            <ul class="nav-list">
            <li><a href="../../index.php">Home</a></li>
            <li><a href="../../dashboard.php">Dashboard</a></li>
            </ul>
            <div class="nav-buttons">
                <button onclick="window.location.href='../../include/close.php'">Cerrar sesión</button>
            </div>
        </nav>
    </header>
    <!-- Contenedor principal con módulos -->
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
                <h3>Recetas</h3>
            </div>
        </div>

        <!-- Columna de contenido -->
        <div class="content-column">
            <h1>Lista de Usuarios</h1>
            <!-- Mostrar botón para agregar usuario solo si el usuario es admin -->
            <?php if ($_SESSION['role_id'] == 1): ?>
                <button onclick="window.location.href='createUser.php'" class="add-user-button">Agregar Usuario</button>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Mostrar cada fila de la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            // Mostrar la contraseña con un máximo de 10 asteriscos
                            $passwordLength = strlen($row['password']);
                            $maskedPassword = str_repeat('*', min($passwordLength, 10));
                            echo "<td>" . $maskedPassword . "</td>";
                            // Mostrar el nombre del rol en lugar del role_id
                            echo "<td>" . $row['role_name'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            // Mostrar botones de acción solo si el usuario es admin
                            echo "<td>";
                            if ($_SESSION['role_id'] == 1) {
                                echo "<button onclick=\"window.location.href='editUser.php?id=" . $row['id'] . "'\" class='edit-button'>Actualizar</button>";
                                echo "<button onclick=\"window.location.href='deleteUser.php?id=" . $row['id'] . "'\" class='delete-button'>Eliminar</button>";
                            } else {
                                echo "<button onclick=\"window.location.href='editUser.php?id=" . $row['id'] . "'\" class='edit-button'>Actualizar</button>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No hay usuarios registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>