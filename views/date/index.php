<?php include_once __DIR__ . "/../templates/bar.php" ?>

<h1 class="name-page">Crear Nueva Cita</h1>

<p class="description-page">Elige tus servicios a coloca tus datos</p>

<div class="app">
    <nav class="tabs">
        <button type="button" data-step="1">Servicios</button>
        <button type="button" data-step="2">Información Cita</button>
        <button type="button" data-step="3">Resumen</button>
    </nav>

    <div id="step-1" class="section">
        <h2>Servicios</h2>
        <p class="text-centered">Elige tus servicios a continuación</p>
        <div class="services-list" id="services"></div>
    </div>

    <div id="step-2" class="section">
        <h2>Tus Datos y Cita</h2>
        <p class="text-centered">Coloca los datos y fecha de tu cita</p>

        <form class="form">
            <div class="field">
                <label for="name">Nombre</label>
                <input type="text" id="name" placeholder="Tu Nombre" value="<?php echo $name; ?>" disabled>
            </div>

            <div class="field">
                <label for="date">Fecha</label>
                <input type="date" id="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
            </div>

            <div class="field">
                <label for="time">Hora</label>
                <input type="time" id="time">
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <div id="step-3" class="section content-abstract">
        <h2>Resumen</h2>
        <p class="text-centered">Verifica que la informacion sea correcta</p>
    </div>

    <div class="indexing">
        <button id="previous" class="button">&laquo; Anterior</button>
        <button id="next" class="button">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</script><script src='build/js/app.js'></script>"; ?>