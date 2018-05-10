<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Exchange Details
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
     
      <div class="row">
        <div class="col-md-6">
          <!-- Box Comment -->
          <div class="box box-primary">
           
            <!-- /.box-header -->
            <div class="box-body">
                <img class="img-responsive pad" src="<?= site_url('dist/img/' . $trade->trade_pic_picture) ?>" alt="Photo">
            </div>  
            
            <div class="box-body">
                <div>
                    <div style="float:left;margin-right:10px;margin-left:25px;" >
                        <img src="<?= site_url('dist/img/' . $trade->trade_pic_picture) ?>" height="100" width="100"  />
                    </div>
                </div>
              </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <!-- Box Comment -->
          <div class="box box-primary">
              <div class="box-header with-border">
                  <div >               
                      <h1><strong><?= $trade->trade_title; ?></strong></h1>
                      <h6 class="description-header">Published - <i class="fa fa-fw fa-clock-o"></i><?= date('d/m/Y', strtotime($trade->trade_date_add)); ?></h6>
                </div>              
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <strong><i class="fa fa-th margin-r-5"></i>Category</strong>
              <div class="box-body">
                  <ul>
                    <li><?= $trade->category_name; ?></li>
                  </ul>
                </div>
              <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
              <div class="box-body">
                  <ul>
                    <li><?= $trade->trade_description; ?></li>
                  </ul>
                </div>

              <strong><i class="fa fa-pencil margin-r-5"></i>Interests</strong>
              <p>
                <span class="label label-danger"><i class="fa fa-gamepad"></i></span>
                <span class="label label-success"><i class="fa fa-book"></i></span>
                <span class="label label-info"><i class="fa fa-mobile-phone"></i></span>
                <span class="label label-warning"><i class="fa fa-tv "></i></span>
              </p>

              <?php if (($trade->trade_id_user_from != $idUserLogged) && ($idUserLogged <> 1)) : ?>
                <hr>
                <div class="row no-print">
                  <div class="col-xs-12">                   
                    <a class="btn btn-success btn-lg btn-flat" href="<?= site_url('Exchange/chooseOffer/'.$trade->trade_id) ?>"><i class="fa fa-exchange"></i> Exchange</a>
                    <a class="btn btn-primary btn-lg btn-flat" href="#"><i class="fa fa-commenting-o"></i> Contact</a>
                  </div>
                </div>
              <?php endif; ?>

            </div>
            <!-- /.box-body -->
           
            <!-- /.box-footer -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

<?php $this->load->view('footer') ?>