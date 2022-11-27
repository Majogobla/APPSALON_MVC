<?php include_once __DIR__ . "/../templates/bar.php" ?>

<h2>Buscar Citas</h2>

<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Fecha</label>
            <input type="date" id="date" name="date" value="<?php echo $day; ?>">
        </div>
    </form>
</div>

<?php 
    if(count($dates) ===0){
        echo "<br></br>";
        echo "<h2>No hay citas</h2>";
    }
?>

<div class="dates-admin">
    <ul class="dates">
        <?php $dateId = null ?>
        <?php foreach($dates as $key => $date): ?>
            <?php if($dateId != $date->id): ?>
            <?php $total = 0 ?>
                <li>
                    <p>ID: <span><?php echo $date->id; ?></span></p>
                    <p>Hora: <span><?php echo $date->time; ?></span></p>
                    <p>Cliente: <span><?php echo $date->client; ?></span></p>
                    <p>Email: <span><?php echo $date->email; ?></span></p>
                    <p>Teléfono: <span><?php echo $date->tel; ?></span></p>
                    <h3>Servicios</h3>
                <?php $dateId = $date->id; ?>
            <?php endif; ?>
                    <p class="service"><?php echo $date->service . " $" . $date->price; ?></p>
                    
                    <?php $total += $date->price ?>

                    <?php 
                        $current = $date->id;
                        $next = $dates[$key +1]->id ?? -1;

                        if(last($current, $next)):?>
                    
                        <p class="total">Total: <span><?php echo '$' . $total; ?></span></p>

                        <form action="/api/delete" method="POST">
                            <input type="hidden" name="id" value="<?php echo $date -> id; ?>">
                            <input type="submit" class="button-delete" value="Eliminar">
                        </form>
                    <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php $script = "<script src='build/js/searcher.js'></script>"; ?>
