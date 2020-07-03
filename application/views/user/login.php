<main id="login-page">
    <div class="container">
        <h1>Login</h1>
        <form method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter a username" value="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter a password" value="">
            </div>
            <a href="<?= site_url('user/forgot')?>">Forgot Password?</a>
            <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>
</main>