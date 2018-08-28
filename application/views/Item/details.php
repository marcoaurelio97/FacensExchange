<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Item Details
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
                <img class="img-responsive pad" src="<?= site_url('dist/img/' . $item->itempic_picture) ?>" alt="Photo">
            </div>  
            
            <div class="box-body">
                <div>
                    <div style="float:left;margin-right:10px;margin-left:25px;" >
                        <img src="<?= site_url('dist/img/' . $item->itempic_picture) ?>" height="100" width="100"  />
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
                      <h1><strong><?= $item->item_title; ?></strong></h1>
                      <h6 class="description-header">Published - <i class="fa fa-fw fa-clock-o"></i><?= date('d/m/Y', strtotime($item->item_date_add)); ?></h6>
                </div>              
              </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <strong><i class="fa fa-th margin-r-5"></i>Category</strong>
              <div class="box-body">
                  <ul>
                    <li><?= $item->category_name; ?></li>
                  </ul>
                </div>
              <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
              <div class="box-body">
                  <ul>
                    <li><?= $item->item_description; ?></li>
                  </ul>
                </div>

              <?php if($wishes):?>
              <strong><i class="fa fa-pencil margin-r-5"></i>Interests</strong>
                <p>
                  <?php foreach($wishes AS $row):?>
                    <i class="<?=$row->typ_class?>" data-toggle="tooltip" title="<?=$row->typ_name?>"></i>
                  <?php endforeach;?>
                </p>              
              <?php endif;?>                                          

              <?php if (($profileItem != $profileLogged) && (!is_null($profileLogged))) : ?>
                <hr>
                <div class="row no-print">
                  <div class="col-xs-12">                   
                    <a class="btn btn-success btn-lg btn-flat" href="<?= site_url('Trade/makeAnOffer/'.$item->item_id) ?>"><i class="fa fa-exchange"></i> Exchange</a>
                    <a class="btn btn-primary btn-lg btn-flat" href="#"><i class="fa fa-commenting-o"></i> Contact</a>
                    <a class="btn btn-info btn-lg btn-flat" href="<?= site_url('Profile/viewProfile/'.$profileItem) ?>"><i class="fa fa-commenting-o"></i> See <?= $item->user_username?> Profile</a>                    
                    <a class="btn btn-danger btn-lg btn-flat" href="<?= site_url('Item/Report/'.$item->item_id) ?>"><i class="fa fa-commenting-o"></i> Report Item</a>                                      
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