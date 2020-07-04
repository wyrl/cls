<main id="login-page">
    <div class="container">
        <h1>Login</h1>
        <form method="POST" class="login-form">

            <?php if (!$is_success) : ?>
                <label class="error-msg text-danger">Incorrect Username or Password.</label>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter a username" value="<?= set_value('username');?>">
                <small class="form-text text-danger"><?php echo form_error('username'); ?></small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter a password" value="">
                <small class="form-text text-danger"><?php echo form_error('password'); ?></small>
            </div>
            <a href="<?= site_url('user/forgot') ?>">Forgot Password?</a>
            
            <label style="display:block" class="mt-2">Don't have an account? <a href="<?= site_url('user/register') ?>">Register</a></label>
            <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>
</main>