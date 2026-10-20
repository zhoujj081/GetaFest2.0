<?php
include 'header.php';

$error = '';
$usuario_validado = '';

if (isset($_POST["enviar"])) {
    $usuario = isset($_POST["usuario_login"]) ? $_POST["usuario_login"] : '';
    $pass = isset($_POST["pass_login"]) ? $_POST["pass_login"] : '';
    if (file_exists("usuarios.txt")) {
        $lineas = file("usuarios.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            list($u, $p) = explode(":", $linea);
            if ($u === $usuario && $p === $pass) {
                $usuario_validado = $usuario;
                break;
            }
        }
        if ($usuario_validado === '') {
            $error = "Usuario o contraseña incorrectos";
        }
    } else {
        $error = "Error: No existe el archivo usuarios.txt";
    }
}
?>

<div class="card">
<?php if ($usuario_validado !== ''): ?>
    <h2>Acceso permitido</h2>
    <p>Bienvenido, <b><?php echo $usuario_validado; ?></b>.</p>
    <form action="index.php" method="post">
        <input type="hidden" name="usuario" value="<?php echo $usuario_validado; ?>">
        <input type="submit" class="btn" value="Continuar al portal">
    </form>
<?php else: ?>
    <h2>Iniciar Sesión</h2>
    <?php if ($error !== ''): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="login.php">
        <div class="form-group">
            <label for="usuario_login">Usuario:</label>
            <input type="text" name="usuario_login" id="usuario_login" required>
        </div>
        <div class="form-group">
            <label for="pass_login">Contraseña:</label>
            <input type="text" name="pass_login" id="pass_login" required>
        </div>
        <input type="submit" class="btn" name="enviar" value="Entrar al Sistema">
    </form>
<?php endif; ?>
</div>

</main></body></html>
