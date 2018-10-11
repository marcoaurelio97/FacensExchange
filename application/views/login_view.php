<?php $this->load->view('header') ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Sign in or register</h1>
    </section>
    <section class="content">
        <?= $this->session->userdata('item'); ?>
        <div class="row">
            <div id="status"></div>
            <div class="col-md-6">  
                <div class="box box-primary">
                    <div class="box-header with-border">           
                        <div class="login-box-body">
                            <p class="login-box-msg"><strong>Sign in to start your session</strong></p>
                            <form action="<?= site_url('Login/login') ?>" method="post">
                                <div class="form-group has-feedback">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8"></div>
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="social-auth-links text-center">
                                <p>- OR -</p>
                                <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="true" data-auto-logout-link="true" data-use-continue-as="true"></div>
                            </div> -->
                        </div>
                    </div>  
                </div>
            </div>
            <div class="col-md-6">   
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="register-box-body">
                            <p class="login-box-msg"><strong>Register a new membership</strong></p>
                            <form action="<?= site_url('Login/register') ?>" method="post">
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" name="username" placeholder="User name" required>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" name="password_confirm" placeholder="Retype password" required>
                                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox icheck" style="margin-left:20px;">
                                            <label>
                                                <input type="checkbox" id="terms" name="terms"> I agree to the <a href="#">terms</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('footer') ?>

<script>
    // function statusChangeCallback(response) {
    //     console.log('statusChangeCallback');
    //     console.log(response);
    //     if (response.status === 'connected') {
    //         debugger;
    //         testAPI(response.authResponse.userID);
    //     } else {
    //         document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
    //     }
    // }

    // // This function is called when someone finishes with the Login
    // // Button.  See the onlogin handler attached to it in the sample
    // // code below.
    // function checkLoginState() {
    //     debugger;
    //     FB.getLoginStatus(function(response) {
    //         debugger;
    //         statusChangeCallback(response);
    //     });
    // }

    // window.fbAsyncInit = function() {
    //     FB.init({
    //         appId   : '352202955521503',
    //         cookie  : true,  // enable cookies to allow the server to access the session
    //         xfbml   : true,  // parse social plugins on this page
    //         version : 'v3.1' // use graph api version 2.8
    //     });

    //     // Now that we've initialized the JavaScript SDK, we call 
    //     // FB.getLoginStatus().  This function gets the state of the
    //     // person visiting this page and can return one of three states to
    //     // the callback you provide.  They can be:
    //     //
    //     // 1. Logged into your app ('connected')
    //     // 2. Logged into Facebook, but not your app ('not_authorized')
    //     // 3. Not logged into Facebook and can't tell if they are logged into
    //     //    your app or not.
    //     //
    //     // These three cases are handled in the callback function.

    //     FB.getLoginStatus(function(response) {
    //         debugger;
    //         statusChangeCallback(response);
    //     });
    // };

    // (function(d, s, id) {
    //     var js, fjs = d.getElementsByTagName(s)[0];
    //     if (d.getElementById(id)) return;
    //     js = d.createElement(s); js.id = id;
    //     // js.src = "https://connect.facebook.net/en_US/sdk.js";
    //     js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1&appId=352202955521503&autoLogAppEvents=1";
    //     fjs.parentNode.insertBefore(js, fjs);
    // }(document, 'script', 'facebook-jssdk'));

    // function testAPI(idUser) {
    //     console.log('Welcome! Fetching your information.... ');
    //     // FB.api('/me', function(response) {
    //     //     debugger;
    //     //     console.log('Successful login for: ' + response.name);
    //     //     document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    //     // });
    //     FB.api('/' + idUser, function(response) {
    //         debugger;
    //         console.log('Successful login for: ' + response.name);
    //         document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    //     });
    // }
</script>