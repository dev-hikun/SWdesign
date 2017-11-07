<?php if($error):?>
    <?php echo $error; ?>
<?php else:?>

    <?php if($upload_data != ''):?>
    <?php foreach($upload_data as $item => $value):?>
        <?php echo $item; ?>
        <?php echo $value; ?>
    <?php endforeach; ?>
    <?php endif; ?>

<?php endif; ?>