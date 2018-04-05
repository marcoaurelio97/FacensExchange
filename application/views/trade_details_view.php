<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Exchange Details
        <small>Facens Exchange</small>
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
                <img class="img-responsive pad" src="<?= site_url('dist/img/photo2.png')?>" alt="Photo">
            </div>  
            
            <div class="box-body">
                <div>
                    <div style="float:left;margin-right:10px;margin-left:25px;" >
                        <img src="<?= site_url('dist/img/photo2.png')?>" height="100" width="100"  />
                    </div>
                    <div style="float:left;margin-right:10px;">
                        <img src="<?= site_url('dist/img/photo2.png')?>" height="100" width="100" />
                    </div>
                    <div style="float:left;margin-right:10px;">
                        <img src="<?= site_url('dist/img/photo2.png')?>" height="100" width="100" />
                    </div>
                    <div style="float:left;margin-right:10px;" >
                        <img src="<?= site_url('dist/img/photo2.png')?>" height="100" width="100"  />
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
                      <h1><strong>Jogo de Cadeiras</strong></h1>
                      <h6 class="description-header">Published - 7:30 PM</h6>
                </div>              
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
              <div class="box-body">
                  <ul>
                    <li>Pouco tempo de uso;</li>
                    <li>Sem nenhuma marca de uso;</li>
                    <li>5 Cadeiras e 1 Mesa;</li>
                    <li>Madeira clara;</li>
                    <li>Top;</li>
                    <li>Aconchegantes.</li>                    
                  </ul>
                </div>

              <strong><i class="fa fa-pencil margin-r-5"></i>Interests</strong>
              <p>
                <span class="label label-danger"><i class="fa fa-gamepad"></i></span>
                <span class="label label-success"><i class="fa fa-book"></i></span>
                <span class="label label-info"><i class="fa fa-mobile-phone"></i></span>
                <span class="label label-warning"><i class="fa fa-tv "></i></span>
              </p>

              <hr>

              <div class="row no-print">
                  <div class="col-xs-12">                   
                    <button type="button" class="btn btn-success btn-lg btn-flat"><i class="fa fa-exchange"></i> Exchange
                    </button>
                    <button type="button" class="btn btn-primary btn-lg btn-flat" style="margin-right: 5px;">
                      <i class="fa fa-commenting-o"></i> Contact
                    </button>
                  </div>
                </div>

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