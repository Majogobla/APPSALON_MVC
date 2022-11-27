<h1 class="name-page">Login</h1>
<p class="description-page">Inicia sesion con tus datos</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>

<form action="/" class="form" method="POST">
    <div class="field">
        <label for="email">Correo</label>
        <input type="email" name="email" id="email" placeholder="Tu Email" required>
    </div>

    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Tu Contraseña" required>
    </div>

    <input type="submit" class="button" value="Iniciar Sesión">
</form>

<div class="actions">
    <a href="/create-account">¿Aún no tienes una cuenta? <span>Crear Una</span></a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>
