<?php
session_start();

// Credenciales hardcodeadas (para práctica)
$admin_user = 'admin';
$admin_pass = 'admin';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === $admin_user && $pass === $admin_pass) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        header("Location: index.php"); // Redirigir al panel
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Calvo & Garcia</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body style="background-color: var(--light-grey);">

    <div class="login-container">
        <h2>Panel de Administración</h2>
        <?php if ($error): ?>
            <p class="error">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <input type="text" name="username" placeholder="Usuario" required
                    style="width: 100%; padding: 10px; margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" required
                    style="width: 100%; padding: 10px; margin-bottom: 20px;">
            </div>
            <button type="submit" class="btn" style="width: 100%;">Entrar</button>
        </form>
        <p style="margin-top: 20px;"><a href="../index.html">← Volver a la web</a></p>
    </div>

</body>

</html>