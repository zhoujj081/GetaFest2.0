<?php include 'header.php';

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '0';

if ($usuario !== 'admin') {
    echo "<div class='card'>";
    echo "<h2>Acceso denegado</h2>";
    echo "<p>Esta sección es exclusiva para administradores.</p>";
    echo "<a href='login.php' class='btn'>Volver al login</a>";
    echo "</div>";
    echo "</main></body></html>";
} else {
    $reservas = array();
    if (file_exists("reservas.txt")) {
        $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    $encontrada = '';
    $contador = 1;
    foreach ($reservas as $reserva) {
        if ($contador == $id) {
            $encontrada = $reserva;
            break;
        }
        $contador++;
    }

    if ($encontrada === '') {
        echo "<div class='card'>";
        echo "<h2>Pase no encontrado</h2>";
        echo "<form method='post' action='ver_reservas.php'>";
        echo "<input type='hidden' name='usuario' value='" . $usuario . "'>";
        echo "<input type='submit' class='btn' value='Volver al listado'>";
        echo "</form>";
        echo "</div>";
    } else {
        list($fecha, $hora, $nombre, $email, $edad, $tipo, $dias, $pago, $precio, $rutaFoto, $observaciones) = explode("|", $encontrada);
        ?>
        <div class="card profile-card">
            <h2>Acreditación #<?php echo $id; ?> (Vista Administrador)</h2>
            <?php if ($rutaFoto != ''): ?>
                <img src="<?php echo $rutaFoto; ?>" alt="Foto del asistente" width="160">
            <?php endif; ?>
            <h3><?php echo $nombre; ?></h3>
            <p><b>Email:</b> <?php echo $email; ?></p>
            <p><b>Edad:</b> <?php echo $edad; ?> años</p>
            <p><b>Tipo de Entrada:</b> <?php echo $tipo; ?></p>
            <p><b>Días de asistencia:</b> <?php echo $dias; ?></p>
            <p><b>Método de pago:</b> <?php echo $pago; ?></p>
            <?php if ($observaciones != ''): ?>
                <p><b>Observaciones:</b> "<?php echo $observaciones; ?>"</p>
            <?php endif; ?>
            <p><b>Total: <?php echo $precio; ?></b></p>
        </div>
        <form method="post" action="ver_reservas.php">
            <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
            <input type="submit" class="btn" value="← Volver al listado de reservas">
        </form>
        <?php
    }
    echo "</main></body></html>";
}
?>
