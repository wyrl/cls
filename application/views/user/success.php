<?php if(!isset($title)):
        $title = "Registered"; ?>
<?php endif;?>

<div class="container">
    <div class="alert alert-success success-register" role="alert">
        <h4 class="alert-heading">Successfully <?php echo $title; ?>!</h4>
        <p>Please click <a href="<?= site_url('user/login') ?>">here</a> to login</p>
    </div>
</div>