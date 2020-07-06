<main id="reset-page">
    <div class="container">
        <h1>Reset Password</h1>
        <form method="POST" class="reset-form">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter a password" value="<?php echo set_value('password'); ?>">
                <small class="form-text text-danger"><?php echo form_error('password'); ?></small>
            </div>
            <div class="form-group">
                <label for="c-password">Confirm Password</label>
                <input type="password" name="c-password" class="form-control" id="c-password" placeholder="Enter a confirm password" value="<?php echo set_value('c-password'); ?>">
                <small class="form-text text-danger"><?php echo form_error('c-password'); ?></small>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>
</main>