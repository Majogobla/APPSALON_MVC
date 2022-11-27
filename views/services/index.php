<?php include_once __DIR__ . '/../templates/bar.php' ?>

<h1 class="name-page">Servicios</h1>

<p class="description-page">Administracion de Servicios</p>

<ul class="services">
    <?php foreach($services as $service): ?>
        <li>
            <p>Nombre: <span><?php echo $service->name; ?></span></p>
            <p>Price: $<span><?php echo $service->price; ?></span></p>

            <div class="actions">
                <a href="/services/update?id=<?php echo $service->id; ?>" class="button">Actualizar</a>

                <form action="/services/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $service->id; ?>">
                    <input type="submit" value="Borrar" class="button-delete">
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>