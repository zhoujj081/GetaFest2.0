<?php
$usuario_header = isset($_POST['usuario']) ? $_POST['usuario'] : '';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DEVMUSIC FEST 2026</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header class="site-header">
    <h1>🎵 DEVMUSIC FEST 2026 🎵</h1>
    <p>Sistema Oficial de Reserva y Acreditación Digital</p>
    <?php if ($usuario_header !== ''): ?>
        <p class="user-info">Usuario activo: <b><?php echo $usuario_header; ?></b> · <a href="login.php">Cerrar Sesión</a> / <a href="login.php">Salir</a></p>
    <?php else: ?>
        <p class="user-info">Acceso al portal: 🔑 <a href="login.php">Iniciar Sesión</a></p>
    <?php endif; ?>
</header>
<main class="container">
