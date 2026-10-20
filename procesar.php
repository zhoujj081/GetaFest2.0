<?php
include 'header.php';

if (!isset($_POST["enviar"])) {
    echo "<div class='card'>";
    echo "<h2>Acceso denegado</h2>";
    echo "<p>No se ha enviado el formulario correctamente.</p>";
    echo "<a href='login.php' class='btn'>Volver al login</a>";
    echo "</div>";
    echo "</main></body></html>";
} else {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $edad = isset($_POST['edad']) ? $_POST['edad'] : 0;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $pago = isset($_POST['pago']) ? $_POST['pago'] : '';
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $hora = isset($_POST['hora']) ? $_POST['hora'] : '';

    $dias = array();
    if (isset($_POST['dias'])) {
        $dias = $_POST['dias'];
    }

    if ($edad < 18) {
        echo "<div class='card'>";
        echo "<h2>Reserva denegada</h2>";
        echo "<p>Lo sentimos <b>" . $nombre . "</b>, el evento es exclusivo para mayores de 18 años.</p>";
        echo "<form method='post' action='index.php'>";
        echo "<input type='hidden' name='usuario' value='" . $usuario . "'>";
        echo "<input type='submit' class='btn' value='Volver al formulario'>";
        echo "</form>";
        echo "</div>";
    } else {
        $rutaFoto = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $origen = $_FILES['foto']['tmp_name'];
            $nombreFoto = $_FILES['foto']['name'];
            $rutaFoto = 'uploads/' . $nombreFoto;
            if (!move_uploaded_file($origen, $rutaFoto)) {
                $rutaFoto = '';
            }
        }

        $precios = array("General" => 50, "VIP" => 120, "SuperVIP" => 180);
        $precioBase = isset($precios[$tipo]) ? $precios[$tipo] : 0;
        $suplemento = count($dias) * 10;
        $precioTotal = $precioBase + $suplemento;

        $diasTexto = implode(",", $dias);

        $linea = $fecha . "|" . $hora . "|" . $nombre . "|" . $correo . "|" . $edad . "|" .
                 $tipo . "|" . $diasTexto . "|" . $pago . "|" . $precioTotal . "€|" .
                 $rutaFoto . "|" . $observaciones . PHP_EOL;

        file_put_contents("reservas.txt", $linea, FILE_APPEND);
        ?>
        <div class="card profile-card">
            <h2>🎫 Acreditación Virtual - Ticket</h2>
            <?php if ($rutaFoto != ''): ?>
                <img src="<?php echo $rutaFoto; ?>" alt="Foto del asistente" width="200">
            <?php endif; ?>
            <h3><?php echo $nombre; ?></h3>
            <p><b>Email:</b> <?php echo $correo; ?></p>
            <p><b>Tipo de pase:</b> <?php echo $tipo; ?></p>
            <p><b>Días de asistencia:</b></p>
            <ul>
                <?php foreach ($dias as $dia): ?>
                    <li><?php echo $dia; ?></li>
                <?php endforeach; ?>
            </ul>
            <p><b>Método de pago:</b> <?php echo $pago; ?></p>
            <?php if ($observaciones != ''): ?>
                <p><b>Observaciones:</b> <?php echo $observaciones; ?></p>
            <?php endif; ?>
            <h3>Desglose del precio</h3>
            <p>Precio Base: <?php echo $precioBase; ?> €</p>
            <p>Suplemento por <?php echo count($dias); ?> día(s): <?php echo $suplemento; ?> €</p>
            <p><b>Precio Total a Pagar: <?php echo $precioTotal; ?> €</b></p>
            <form method="post" action="ver_reservas.php">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="submit" class="btn" value="Ver reservas">
            </form>
        </div>
        <?php
    }
    echo "</main></body></html>";
}
?>
