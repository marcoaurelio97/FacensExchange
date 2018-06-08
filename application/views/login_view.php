<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sign in or register
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?= $this->session->userdata('item'); ?>
          <div class="row">
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
                      <div class="col-xs-8">
                      </div>
                      <!-- /.col -->
                      <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>
              
                  <div class="social-auth-links text-center">
                    <p>- OR -</p>
                      <div class="g-signin2" data-onsuccess="onSignIn" data-width="200" data-theme="dark" data-longtitle="true"></div>
                  </div>
                </div>  </div>  
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
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    
        
      </div>
  </div>
  </div>
  </div>
</div>
</section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>

<script>
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    var data        = {};
    data.id         = profile.getId();
    data.name       = profile.getName();
    data.givenName  = profile.getGivenName();
    data.familyName = profile.getFamilyName();
    data.imageURL   = profile.getImageUrl();
    data.email      = profile.getEmail();

    url = "<?= base_url('Login/loginGoogle'); ?>";

    $.post(url, data, function(resp){
      window.location.href = resp.url;
    }, 'json');
  }
</script>