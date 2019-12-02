<?php
require __DIR__ . '/config/bootstrap.php';


include INC . 'header.php';
include INC . 'nav.php';
?>

<!-- SHOP CONTENT -->
<section id="content">
    <div class="content-blog">
        <div class="container">
            <div class="row">
                <div class="page_header text-center">
                    <h2>Account</h2>
                    <p><?php echo getenv('STORE_TAGLINE'); ?></p>
                </div>
                <div class="col-md-12">
                    <div class="row shop-login">
                        <div class="col-md-6">
                            <div class="box-content">
                                <h3 class="heading text-center">I'm a Returning Customer</h3>
                                <div class="clearfix space40"></div>
                                <?php if (isset($_GET['message'])) {
                                    if ($_GET['message'] === 'login-error') {
                                        ?><div class="alert alert-danger" role="alert"><?php echo "Sorry, we could not log you in with that email and password combination. Please try again."; ?> </div>
                                        <?php
                                    } else if ($_GET['message'] === 'invalid-account') {
                                        ?><div class="alert alert-danger" role="alert"><?php echo "That email address is not registered on our system. Please try again with another email address."; ?></div>
                                        <?php
                                    }
                                } ?>
                                <form class="logregform" method="post" action="<?php echo getenv('STORE_URL'); ?>/loginprocess.php">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>E-mail Address</label>
                                                <input type="email" name="email" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix space20"></div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <!-- <a class="pull-right" href="#">(Lost Password?)</a> -->
                                                <label>Password</label>
                                                <input type="password" name="password" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix space20"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="remember-box checkbox">
                                                    <label for="rememberme">
                                                    <input type="checkbox" id="rememberme" name="rememberme">Remember Me
                                                </label>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="button btn-md pull-right">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-content">
                                <h3 class="heading text-center">Register An Account</h3>
                                <div class="clearfix space40"></div>
                                <?php if (isset($_GET['message'])) {
                                    if ($_GET['message'] === 'general-error') {
                                        ?><div class="alert alert-danger" role="alert"><?php echo "Something went wrong while trying to create your account. Are you sure that you haven't already registered before with your email address?"; ?></div>
                                        <?php
                                    } else if ($_GET['message'] === 'password-mismatch') {
                                        ?><div class="alert alert-danger" role="alert"><?php echo "Your passwords do not match. Please try again."; ?></div>
                                        <?php
                                    }
                                } ?>
                                <form class="logregform" method="post" action="registerprocess.php">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>E-mail Address</label>
                                                <input type="email" name="email" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix space20"></div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label>Password</label>
                                                <input type="password" name="password" value="" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Re-enter Password</label>
                                                <input type="password" name="password_again" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="space20"></div>
                                            <button type="submit" class="button btn-md pull-right">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INC . 'footer.php'; ?>
