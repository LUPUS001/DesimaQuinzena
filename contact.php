<?php
// Incluir conexión a la BD
require_once 'includes/db.php';

$mensaje_estado = "";
$clase_estado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $motivo = htmlspecialchars(trim($_POST['motivo']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // Validar checkbox GDPR
    if (!isset($_POST['privacidad'])) {
        $mensaje_estado = "Debe aceptar la política de privacidad.";
        $clase_estado = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje_estado = "El email no es válido.";
        $clase_estado = "error";
    } else {
        // Insertar en BD
        try {
            $sql = "INSERT INTO contactos (nombre, email, telefono, motivo, mensaje) VALUES (:nombre, :email, :telefono, :motivo, :mensaje)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':telefono' => $telefono,
                ':motivo' => $motivo,
                ':mensaje' => $mensaje
            ]);

            $mensaje_estado = "¡Mensaje enviado con éxito! Nos pondremos en contacto pronto.";
            $clase_estado = "success";
        } catch (PDOException $e) {
            $mensaje_estado = "Error al enviar el mensaje: " . $e->getMessage();
            $clase_estado = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Formulario de contacto de Calvo & Garcia Abogados. Consultas legales en Madrid.">
    <title>Calvo & Garcia Abogados | Contacto</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        form {
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
        }

        button[type="submit"] {
            width: 100%;
            border: none;
            cursor: pointer;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <nav role="navigation">
                <div class="logo">
                    <a href="index.html">CALVO & GARCIA</a>
                </div>
                <ul class="nav-links">
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="about.html">Nosotros</a></li>
                    <li><a href="services.html">Servicios</a></li>
                    <li><a href="contact.php" class="active">Contacto</a></li>
                    <!-- Buscador Visual -->
                    <li class="search-box">
                        <input type="text" placeholder="Buscar...">
                        <button type="button" aria-label="Buscar">🔍</button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="breadcrumbs">
            <div class="container">
                <a href="index.html">Inicio</a> <span>/</span> Contacto
            </div>
        </div>

        <section class="container">
            <h1 class="section-title">Contáctenos</h1>
            <p style="text-align: center; margin-bottom: 20px;">Estamos aquí para ayudarle. Cuéntenos su caso.</p>

            <?php if ($mensaje_estado): ?>
                <div class="alert <?php echo $clase_estado; ?>">
                    <?php echo $mensaje_estado; ?>
                </div>
            <?php endif; ?>

            <div class="contact-grid">
                <div>
                    <h2>Envíenos un mensaje</h2>
                    <form action="contact.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo:</label>
                            <input type="text" id="nombre" name="nombre" required placeholder="Su nombre">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" placeholder="Su teléfono de contacto">
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo de la consulta:</label>
                            <select id="motivo" name="motivo">
                                <option value="civil">Derecho Civil / Familia</option>
                                <option value="penal">Derecho Penal</option>
                                <option value="laboral">Derecho Laboral</option>
                                <option value="mercantil">Derecho Mercantil</option>
                                <option value="otro">Otros</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea id="mensaje" name="mensaje" rows="5" required
                                placeholder="Describa brevemente su situación..."></textarea>
                        </div>
                        <!-- Checkbox GDPR Obligatorio -->
                        <div class="form-group" style="display: flex; align-items: flex-start; gap: 10px;">
                            <input type="checkbox" id="privacidad" name="privacidad" required
                                style="width: auto; margin-top: 5px;">
                            <label for="privacidad" style="display: inline; font-weight: normal; font-size: 0.9rem;">
                                He leído y acepto la <a href="legal.html#privacidad"
                                    style="text-decoration: underline; color: var(--secondary-color);">Política de
                                    Privacidad</a> y consiento el tratamiento de mis datos.
                            </label>
                        </div>
                        <button type="submit" class="btn">Enviar Consulta</button>
                    </form>
                </div>

                <div>
                    <h2>Información de Contacto</h2>
                    <div style="background-color: var(--light-grey); padding: 30px; border-radius: 8px;">
                        <p><strong>Dirección:</strong><br>
                            Calle Mayor, 12, 1ºA<br>
                            28013 Madrid, España</p>
                        <br>
                        <p><strong>Teléfono:</strong><br>
                            <a href="tel:+34912345678" style="color: var(--primary-color);">91 234 56 78</a>
                        </p>
                        <br>
                        <p><strong>Email:</strong><br>
                            <a href="mailto:info@calvoygarcia.es"
                                style="color: var(--primary-color);">info@calvoygarcia.es</a>
                        </p>
                        <br>
                        <p><strong>Horario:</strong><br>
                            L-J: 9:00 - 18:00 | V: 9:00 - 15:00</p>
                    </div>

                    <div
                        style="margin-top: 30px; height: 300px; background-color: #eee; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <span style="color: #666;">[Mapa Google Maps]</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Calvo & Garcia</h3>
                    <p>Su despacho de confianza.</p>
                </div>
                <div class="footer-column">
                    <h3>Enlaces Rápidos</h3>
                    <ul>
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="about.html">Nosotros</a></li>
                        <li><a href="services.html">Servicios</a></li>
                        <li><a href="contact.php">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contacto</h3>
                    <ul>
                        <li>📍 Calle Mayor, 12, 1ºA, Madrid</li>
                        <li>📧 info@calvoygarcia.es</li>
                        <li>📞 91 234 56 78</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Calvo & Garcia Abogados. Todos los derechos reservados.</p>
                <div style="margin-top: 10px;">
                    <a href="legal.html">Aviso Legal</a> | <a href="legal.html#privacidad">Política de Privacidad</a> |
                    <a href="legal.html#cookies">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Banner de Cookies -->
    <div id="cookie-banner" class="cookie-banner">
        <p>Utilizamos cookies propias y de terceros para mejorar su experiencia. <a href="legal.html#cookies">Más
                información</a>.</p>
        <button id="accept-cookies" class="btn btn-sm">Aceptar</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const banner = document.getElementById('cookie-banner');
            const acceptBtn = document.getElementById('accept-cookies');
            if (localStorage.getItem('cookiesAccepted') === 'true') {
                banner.style.display = 'none';
            }
            acceptBtn.addEventListener('click', function () {
                banner.style.display = 'none';
                localStorage.setItem('cookiesAccepted', 'true');
            });
        });
    </script>
</body>

</html>