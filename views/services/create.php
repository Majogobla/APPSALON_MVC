<?php include_once __DIR__ . '/../templates/bar.php' ?>

<h1 class="name-page">Nuevo Servicio</h1>

<p class="description-page">Llena todos los campos para añadir un nuevo servicio</p>

<?php include_once __DIR__ . '/../templates/alerts.php' ?>

<form action="/services/create" method="POST" class="form">
    <?php include_once __DIR__ . '/form.php' ?>

    <input type="submit" class="button" value="Guardar Servicio">
</form>