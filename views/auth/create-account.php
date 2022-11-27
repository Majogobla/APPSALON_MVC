<h1 class="name-page">Crear Cuenta</h1>

<p class="description-page">Llena el siguiente fromaulario para crear una cuenta</p>

<?php include_once __DIR__ . "/../templates/alerts.php" ?>

<form action="/create-account" class="form" method="POST">
    <div class="field">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" placeholder="Tu Nombre" value="<?php echo s($user->name); ?>" required>
    </div>

    <div class="field">
        <label for="surname">Apellido</label>
        <input type="text" id="surname" name="surname" placeholder="Tu Apellido" value="<?php echo s($user->surname); ?>" required>
    </div>

    <div class="field">
        <label for="tel">Teléfono</label>
        <input type="tel" id="tel" name="tel" placeholder="Tu Teléfono" value="<?php echo s($user->tel); ?>" required>
    </div>

    <div class="field">
        <label for="email">Correo</label>
        <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($user->email); ?>" required>
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu Password" required>
    </div>

    <input type="submit" value="Crear Cuenta" class="button">
</form>

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? <span>Inicia Sesion</span></a>
    <a href="/forgot">¿Olvidaste tu password?</a>
</div>