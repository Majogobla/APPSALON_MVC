<?php foreach($alerts as $type => $messages): ?>
    <?php foreach($messages as $mesage): ?>
        <div class="alert <?php echo $type; ?>">
            <?php echo $mesage; ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>