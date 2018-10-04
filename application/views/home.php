<?php $this->load->view('header') ?>

<style>
  #fotinho img {
      width:250px;
      height:200px;
  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <h1 class="col-md-12">Home</h1>
      </div>
    </section>
    <div class="row col-md-12 box box-solid">
    <div class="col-xs-6">   
          <div class="box-body">          
            <div class="box-header">
              <h3 class="box-title">Top Changes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First Change">

                    <div class="carousel-caption">
                      First Change
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second Change">

                    <div class="carousel-caption">
                      Second Change
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third Change">

                    <div class="carousel-caption">
                      Third Change
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?= $this->session->userdata('item'); ?>
      <div>

          <div class="row">
          <?php if ($items) { ?>
          <?php foreach ($items as $row) { ?>
          <div class="col-md-4" style="min-height: 500px;">
              <div class="box box-solid box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?= $row->item_title ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="container" id="fotinho">
                    <?php if ($row->itempic_picture) : ?>
                      <img class="img-responsive pad" src="<?= site_url('dist/img/' . $row->itempic_picture); ?>" alt="Photo">
                    <?php else : ?>
                      <img class="img-responsive pad" src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                    <?php endif; ?>
                  </div>
                </div><!-- /.box-body -->
                <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                  <div class="box-body">
                      <ul>
                        <li><?= $row->item_description ?></li>
                      </ul>
                    </div>
                    <div class="box-body"  style="margin-left:10px;">
                        <strong><i class="fa fa-pencil margin-r-5" ></i>Interests</strong>
                        <p>
                          <?php if($row->wishes): ?>
                            <?php foreach($row->wishes AS $teste):?>
                              <i class="<?=$teste->typ_class?>" data-toggle="tooltip" title="<?=$teste->typ_name?>"></i>
                            <?php endforeach;?>
                          <?php else: ?>
                            <?='There is no interests'?>
                          <?php endif;?>
                        </p>
                      </div>

                <!-- <button type="button" class="btn btn-block btn-primary btn-flat" >More info</button> -->
                <a class="btn btn-block btn-primary btn-flat" href="<?= site_url('Item/itemDetails/' . $row->item_id) ?>">More info</a>
              </div><!-- /.box -->
            </div>
            <?php 
          } ?>
            <?php 
          } else { ?>
              <div class="container pull-left" style="width:100%;">
                  <div class='alert alert-info alert-dismissible'>
                      No items available
                  </div>
              </div>
            <?php 
          } ?>
          </div>
      </div>
    </section>
    </div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>