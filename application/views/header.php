<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Facens Exchange</title>
  <link rel="icon" href="<?= site_url('dist/img/icon_title.png') ?>" type="image/x-icon" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="google-signin-client_id" content="529581074299-ptsebcdfpuo5q6mjjmb5lscksg42p50q.apps.googleusercontent.com">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= site_url('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= site_url('bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= site_url('bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= site_url('dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= site_url('dist/css/skins/_all-skins.min.css') ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= site_url('bower_components/morris.js/morris.css') ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= site_url('bower_components/jvectormap/jquery-jvectormap.css') ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= site_url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= site_url('bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= site_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- fontIconPicker -->
  <link rel="stylesheet" href="<?= site_url('bower_components/iconpicker/css/jquery.fonticonpicker.min.css') ?>" />
  <link rel="stylesheet" href="<?= site_url('bower_components/iconpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css') ?>"/>
  <!-- Font -->
  <link rel="stylesheet" href="<?= site_url('bower_components/iconpicker/demo/fontello-7275ca86/css/fontello.css') ?>"/>
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= site_url('bower_components/daterangepicker-bs3.css') ?>"/>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= site_url('Home') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>EX</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Facens</b> Exchange</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          <?php if ($this->session->userdata('logged')) : ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?= count($this->session->userdata('notifications')) != 0 ? count($this->session->userdata('notifications')) : '' ?></span>
            </a>
            <ul class="dropdown-menu">
              <?php if ($this->session->userdata('notifications')) : ?>
              <li class="header">You have <?= count($this->session->userdata('notifications')) ?> notification(s)</li>
              <li>
                <ul class="menu">
                  <?php foreach ($this->session->userdata('notifications') AS $row) : ?>
                    <li>
                      <a href="<?= site_url('Exchange/exchangeConfirmation/'.$row->notif_id.'/'.$row->notif_tradeoffer_id) ?>"><i class="fa fa-exchange text-aqua"></i> <?= $row->notif_message ?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
              <?php else : ?>
                <li class="header">You don't have any notification</li>
                  <li>
                    <ul class="menu">
                      <li>
                      </li>
                    </ul>
                  </li>
                <?php endif; ?>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-exchange"></i>
              <span class="label label-danger"><?= count($this->session->userdata('offersNotifications')) != 0 ? count($this->session->userdata('offersNotifications')) : '' ?></span>
            </a>
            <ul class="dropdown-menu">
              <?php if ($this->session->userdata('offersNotifications')) : ?>
                <li class="header">You have <?= count($this->session->userdata('offersNotifications')) ?> Offer(s)</li>
                <li>
                  <ul class="menu">
                    <?php foreach ($this->session->userdata('offersNotifications') as $row) : ?>
                      <li>
                        <a href="<?= site_url('Exchange/viewOffer/' . $row->trade_id) ?>"><i class="fa fa-shopping-cart text-green"></i> <?=  '<strong>'.$row->offeredToMe.'</strong> for your <strong>'.$row->myTrade.'</strong>'; ?></a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">View all offers</a>
                </li>
              <?php else : ?>
              <li class="header">You don't have any offer</li>
                <li>
                  <ul class="menu">
                    <li>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if ($this->session->userdata('logged')) { ?>
                <?php if ($this->session->userdata('proPicture')) { ?>
                   <img src="<?= site_url('dist/img/'.$this->session->userdata('proPicture')) ?>" class="user-image" alt="User Image">
                <?php } else { ?>
                  <img src="<?= site_url('dist/img/user-default.jpg') ?>" class="user-image" alt="User Image">
                <?php } ?>
            <?php 
            } else { ?>            
                      <img src="<?= site_url('dist/img/user-default.jpg') ?>" class="user-image" alt="User Image">
              <?php 
            } ?>
            
              <span class="hidden-xs">
              <?php if ($this->session->userdata('logged')) { ?>          
                    <?php echo $this->session->userdata('userName'); ?>      
               <?php 
            } else { ?>            
                    Guest       
              <?php 
            } ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <?php if ($this->session->userdata('logged')) { ?>                
                <?php if ($this->session->userdata('proPicture')) { ?>
                   <img src="<?= site_url('dist/img/'.$this->session->userdata('proPicture')) ?>" class="user-image" alt="User Image">
                <?php } else { ?>
                  <img src="<?= site_url('dist/img/user-default.jpg') ?>" class="user-image" alt="User Image">
                <?php } ?>
               <?php 
            } else { ?>                  
                      <img src="<?= site_url('dist/img/user-default.jpg') ?>" class="img-circle" alt="User Image">      
              <?php 
            } ?>
                <?php if ($this->session->userdata('logged')) { ?>                
                    <p>
                    <?php echo $this->session->userdata('userName'); ?>        
                    <small><?php echo $this->session->userdata('email'); ?></small>
                    </p>              
                <?php 
              } else { ?>                  
                    <p>
                    Guest
                  <small>Login to exchange items.</small>
                </p>       
              <?php 
            } ?>
                
              </li>
              <!-- Menu Body -->
              <?php if ($this->session->userdata('logged')) : ?>
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="<?= site_url('Profile/favorites/'.$this->session->userdata('idUser')) ?>"><i class="fa fa-fw fa-star"></i> Favorites</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?= site_url('Item/listItems') ?>"><i class="fa fa-fw fa-list"></i><br>Items</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?= site_url('User/listTrades') ?>"><i class="fa fa-fw fa-exchange"></i> Exchanges</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <?php endif; ?>
              <!-- Menu Footer-->
              <li class="user-footer">              
                  <div class="text-center">                  
                    <?php if ($this->session->userdata('logged')) : ?>
                      <a href="<?php echo site_url('profile/editProfile/'.$this->session->userdata('idUser'))?>" class="btn btn-primary btn-flat">Profile</a>   
                        <?php if ($this->session->userdata('idUser') <> 1) : ?>
                          <a href="<?= site_url('Item/addItem') ?>" class="btn btn-warning btn-flat">Add Item</a>
                        <?php endif; ?>
                        <?php if ($this->session->userdata('loginGoogle')) : ?>
                          <a href="<?= site_url('Login/signOut') ?>" class="btn btn-danger btn-flat">Sign out</a>
                          <!-- <a href="#" class="btn btn-danger btn-flat" onclick="signOut();">Sign out</a> -->
                        <?php else : ?>
                          <a href="<?= site_url('Login/signOut') ?>" class="btn btn-danger btn-flat">Sign out</a>
                        <?php endif; ?>
                      <?php else : ?>
                        <a href="<?= site_url('Login') ?>" class="btn btn-success btn-flat">Sign in</a>
                      <?php endif; ?>
                  </div>
             </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <?php if ($this->session->userdata('logged') AND !is_null($this->session->userdata('proPicture'))) : ?>  
        <div class="user-panel">
        <div class="pull-left image">
            <?php if ($this->session->userdata('proPicture')) { ?>
                   <img src="<?= site_url('dist/img/'.$this->session->userdata('proPicture')) ?>" class="img-circle" alt="User Image">
                <?php } else { ?>
                  <img src="<?= site_url('dist/img/user-default.jpg') ?>" class="img-circle" alt="User Image">
                <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('userName'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>            
      <?php endif; ?>
      <!-- search form -->
      <form action="<?= site_url('Exchange/searchOffers') ?>" method="post" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= isset($search) ? $search : '' ?>">
          <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <li class="active ">
            <a href="<?= site_url('Home') ?>">
              <i class="fa fa-home"></i> <span>Home</span>
            </a>            
          </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($this->session->userdata('categories')) : ?>
              <?php foreach ($this->session->userdata('categories') as $row) : ?>
                <li class="active"><a href="<?= site_url('Home/' . $row->category_id) ?>"><?= $row->category_name ?></a></li>
            <!-- <li class="active"><a href="index.html"><i class="fa fa-car"></i> Car</a></li>
            <li class="active"><a href="index.html"><i class="fa fa-legal"></i> Tools</a></li>
            <li class="active"><a href="index.html"><i class="fa fa-gamepad"></i> Toys</a></li>
            <li class="active"><a href="index.html"><i class="fa fa-book"></i> Books</a></li>
            <li class="active"><a href="index2.html"><i class="fa fa-futbol-o"></i> Sports</a></li> -->
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </li>
        <?php if ($this->session->userdata('admin')) : ?>
                   <li class=" treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i> <span>Administrator</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?= site_url('Category/listCategories') ?>">Categories</a></li>
            <li class="active"><a href="<?= site_url('User/listUsers') ?>">List Users</a></li>
            <!-- <li class="active"><a href="<?= site_url('Exchange/listTrades') ?>">List Trades</a></li> -->
          </ul>
        </li>    
      <?php endif; ?>
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>