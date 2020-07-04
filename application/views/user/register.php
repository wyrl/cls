<main id="register-page">
  <div class="container">
    <h1>Register</h1>
    <form method="POST" class="register-form">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter a firstname" value="<?php echo set_value('firstname'); ?>">
            <small class="form-text text-danger"><?php echo form_error('firstname'); ?></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter a lastname" value="<?php echo set_value('lastname'); ?>">
            <small class="form-text text-danger"><?php echo form_error('lastname'); ?></small>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Enter a email" value="<?php echo set_value('email'); ?>">
        <small class="form-text text-danger"><?php echo form_error('email'); ?></small>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter a username" value="<?php echo set_value('username'); ?>">
        <small class="form-text text-danger"><?php echo form_error('username'); ?></small>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter a password" value="<?php echo set_value('password'); ?>">
            <small class="form-text text-danger"><?php echo form_error('password'); ?></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="c-password">Confirm Password</label>
            <input type="password" name="c-password" class="form-control" id="c-password" placeholder="Enter a confirm password" value="<?php echo set_value('c-password'); ?>">
            <small class="form-text text-danger"><?php echo form_error('c-password'); ?></small>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <label style="margin-top: 2.5rem;" ><a href="<?= site_url('user/login')?>">Login</a>, if you have already registered.</label>
    </form>
  </div>
</main>