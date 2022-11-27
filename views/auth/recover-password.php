<h1 class="name-page">Recuperar Password</h1>

<p class="description-page">Coloca tu nuevo password a continuación</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>

<!-- Validamos el token para mostrar el formulario -->
<?php if(!$invalid) : ?>
<form class="form" method="POST">
    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Nuevo Password" required>
    </div>

    <input type="submit" class="button" value="Guardar Nuevo Password">
</form>
<?php endif; ?>

<div class="actions">
    <a href="/">¿Ya tienes cuenta? <span>Inicia Sesion</span></a>
    <a href="/create-account">¿A'un no tienes cuenta? <span>Crear Una</span></a>
</div>