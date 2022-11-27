<h1 class="name-page">Olvidé mi Contraseña</h1>

<p class="description-page">Reestablezca su contraseña escribiendo su correo a continuación</p>

<?php include_once __DIR__ . "/../templates/alerts.php" ?>

<form action="/forgot" class="form" method="POST">
    <div class="field">
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" placeholder="Tu Correo" required>
    </div>

    <input type="submit" class="button" value="Continuar">
</form>

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? <span>Inicia Sesion</span></a>
    <a href="/create-account">¿Aún no tienes una cuenta? <span>Crear Una</span></a>
</div>
