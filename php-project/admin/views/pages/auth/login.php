<?php
if(isset($_SESSION['id'])){
    header("Location: dashboard");
};
require_once 'models/auth.class.php';
if(isset($_POST['email']) && isset($_POST['pass'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $auth = Auth::login($email, $pass);
    // print_r($auth);
    if(isset($auth['error'])) {
        $msg = $auth['error'];
    }else{
        // print_r($auth);
        $_SESSION['id'] = $auth['id'];
        $_SESSION['role_id'] = $auth['role_id'];
        header("Location: dashboard");
    }
    
}
// echo password_hash("123", PASSWORD_DEFAULT);
?>
<style>
    .main-sidebar, .main-header, .main-footer
    {
        display: none;
    }
</style>
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="dashboard"><b>E</b>Com</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">                
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="admin@mail.com" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pass" value="123" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <p class="text-danger text-center font-weight-bold mb-1"><?php echo $msg ?? "" ?></p>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>