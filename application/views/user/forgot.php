<main id="forgot-page">
    <div class="container">
        <h1 class="text-center">Forgot Password?</h1>
        <form role="form" autocomplete="off" class="forgot-form" method="post">
            <p>You can reset your password here.</p>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                    <input id="email" name="email" placeholder="email address" class="form-control" type="email" value="<?= set_value('email');?>">
                </div>
                <small class="form-text text-danger"><?php echo form_error('email'); ?></small>
            </div>
            <div class="form-group">
                <input name="recover-submit" class="btn btn-primary btn-block" value="Reset Password" type="submit">
            </div>

            <input type="hidden" class="hide" name="token" id="token" value="">
        </form>
    </div>
</main>