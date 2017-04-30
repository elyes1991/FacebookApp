<?php $title = "404 Not Found" ?>
<?php ob_start() ?>
<div class="row">
    <div class="col-md-12">
        <div class="error-template">
            <h1>Oops!</h1>
            <h2>404 Not Found</h2>
            <div class="error-details">
                Sorry, an error has occured, Requested page not found!
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include 'Layout.php'; ?>

