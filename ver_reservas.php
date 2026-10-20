<?php include 'header.php';

$reservas = array();
if (file_exists("reservas.txt")) {
    $reservas = file("reservas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
?>

<div class="card">
    <h2>Listado de Reservas</h2>
    <?php if (count($reservas) == 0): ?>
        <p>No hay reservas todavía.</p>
    <?php else: ?>
        <table class="tabla-reservas">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Pase</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
            <?php
            $id = 1;
            foreach ($reservas as $reserva) {
                list($fecha, $hora, $nombre, $email, $edad, $tipo, $dias, $pago, $precio, $rutaFoto, $observaciones) = explode("|", $reserva);
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>" . $fecha . " " . $hora . "</td>";
                echo "<td>" . $nombre . "</td>";
                echo "<td>" . $email . "</td>";
                echo "<td>" . $edad . "</td>";
                echo "<td>" . $tipo . "</td>";
                echo "<td>" . $pago . "</td>";
                echo "<td>" . $precio . "</td>";
                echo "<td>";
                echo "<form method='post' action='ver_pase.php'>";
                echo "<input type='hidden' name='id' value='" . $id . "'>";
                echo "<input type='hidden' name='usuario' value='" . $usuario . "'>";
                echo "<input type='submit' class='btn-link' value='Ver Pase'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                $id++;
            }
            ?>
        </table>
    <?php endif; ?>
    <form method="post" action="index.php">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
        <input type="submit" class="btn" value="Nueva reserva">
    </form>
</div>

</main></body></html>
