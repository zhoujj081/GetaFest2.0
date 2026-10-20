<?php
$usuario_form = isset($_POST['usuario']) ? $_POST['usuario'] : '';
include 'header.php';

if ($usuario_form === '') {
    echo "<div class='card'>";
    echo "<h2>Acceso requerido</h2>";
    echo "<p>Debes <a href='login.php'>iniciar sesión</a> para hacer una reserva.</p>";
    echo "</div>";
    echo "</main></body></html>";
} else {
?>
<div class="card">
    <h2>Reserva tu Pase</h2>
    <form method="post" action="procesar.php" enctype="multipart/form-data">
        <input type="hidden" name="usuario" value="<?php echo $usuario_form; ?>">

        <div class="form-group">
            <label for="nombre">Nombre completo:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo electrónico:</label>
            <input type="email" name="correo" id="correo" required>
        </div>

        <div class="form-group">
            <label for="edad">Edad:</label>
            <input type="number" name="edad" id="edad" min="1" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha (AAAA-MM-DD):</label>
            <input type="text" name="fecha" id="fecha" placeholder="2026-10-20" required>
        </div>

        <div class="form-group">
            <label for="hora">Hora (HH:MM):</label>
            <input type="text" name="hora" id="hora" placeholder="20:00" required>
        </div>

        <div class="form-group">
            <label>Tipo de Pase:</label>
            <div class="checkbox-group">
                <label><input type="radio" name="tipo" value="General" required> General (50 €)</label>
                <label><input type="radio" name="tipo" value="VIP"> VIP (120 €)</label>
                <label><input type="radio" name="tipo" value="SuperVIP"> Super VIP + Camping (180 €)</label>
            </div>
        </div>

        <div class="form-group">
            <label>Días de asistencia:</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="dias[]" value="Viernes"> Viernes (+10 €)</label>
                <label><input type="checkbox" name="dias[]" value="Sabado"> Sábado (+10 €)</label>
                <label><input type="checkbox" name="dias[]" value="Domingo"> Domingo (+10 €)</label>
            </div>
        </div>

        <div class="form-group">
            <label for="pago">Método de pago:</label>
            <select name="pago" id="pago" required>
                <option value=""> Selecciona </option>
                <option value="Tarjeta">Tarjeta de crédito</option>
                <option value="Bizum">Bizum</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="foto">Foto del asistente:</label>
            <input type="file" name="foto" id="foto" required>
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones"></textarea>
        </div>

        <input type="submit" class="btn" name="enviar" value="Reservar mi pase">
    </form>
</div>
<?php
    echo "</main></body></html>";
}
?>
