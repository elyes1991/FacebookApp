<?php $title = "Profile - ".$name ?>

<?php ob_start() ?>

<h1> <?php echo "$name" ?></h1>

<img src="<?php echo "$imageUrl" ?>" />

<?php $content = ob_get_clean() ?>

<?php include 'Layout.php' ?>