<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos
require_once '../includes/db.php';

// Obtener mensajes
try {
    $stmt = $pdo->query("SELECT * FROM contactos ORDER BY fecha_envio DESC");
    $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener mensajes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin | Calvo & Garcia</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .admin-table th,
        .admin-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .admin-table th {
            background-color: var(--primary-color);
            color: white;
        }

        .logout {
            float: right;
            color: var(--secondary-color);
            font-weight: bold;
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <nav>
                <div class="logo">PANEL ADMIN</div>
                <ul class="nav-links">
                    <li>Hola,
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </li>
                    <li><a href="logout.php" class="logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1 class="section-title">Mensajes Recibidos</h1>

        <?php if (count($mensajes) > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Motivo</th>
                        <th>Mensaje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mensajes as $msg): ?>
                        <tr>
                            <td>
                                <?php echo date('d/m/Y H:i', strtotime($msg['fecha_envio'])); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($msg['nombre']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($msg['email']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($msg['motivo']); ?>
                            </td>
                            <td>
                                <?php echo nl2br(htmlspecialchars($msg['mensaje'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center;">No hay mensajes nuevos.</p>
        <?php endif; ?>
    </main>

</body>

</html>