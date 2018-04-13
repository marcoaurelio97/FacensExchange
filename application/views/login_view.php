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
      <?php echo $this->session->userdata('item'); ?>
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
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                      Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                      Google+</a>
                  </div>
                  <!-- /.social-auth-links -->
              
                  <a href="#">I forgot my password</a><br>
                  <a href="register.html" class="text-center">Register a new membership</a>
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
            <input type="text" class="form-control" name="name" placeholder="Full name" required>
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
    
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
            Google+</a>
        </div>
    
        <a href="login.html" class="text-center">I already have a membership</a>
      </div>
  </div>
  </div>
  </div>
</div>
</section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>