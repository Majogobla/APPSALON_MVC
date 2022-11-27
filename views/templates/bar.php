<div class="bar">
    <p>Hola: <span><?php echo $name ?? ''; ?></span></p>
    <a href="/logout" class="button">Cerrar sesión</a>
</div>

<?php if(isset($_SESSION['admin'])): ?>
    <div class="services-bar">
        <a href="/admin" class="button">Ver Citas</a>
        <a href="/services" class="button">Ver Servicios</a>
        <a href="/services/create" class="button">Nuevo Servicio</a>
    </div>

<?php endif; ?>