<?php $title = "Login" ?>

<?php ob_start() ?>

<h1> Login with Facebook</h1>
<a href="<?php echo "$loginUrl"?>" class="btn btn-lg btn-primary">
    <i class="fa fa-facebook visible-xs"></i>
    <span class="hidden-xs">Login</span>
</a>

<?php $content = ob_get_clean() ?>

<?php include 'Layout.php'; ?>