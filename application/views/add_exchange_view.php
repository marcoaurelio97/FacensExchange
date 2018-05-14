<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Exchange
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
     
      <div class="row container">
      
        <!-- /.col -->
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title"><strong>Exchange Infos</strong></h2>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="<?= site_url('Exchange/addTrade') ?>" method="post" enctype="multipart/form-data">                
                  <div class="box-body">
                    <div class="form-group">
                      <strong><i class="fa fa-edit margin-r-5"></i>Title</strong>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo (isset($trade)) ? $trade->trade_title : "";?>" placeholder="Enter a title of exchange" required>
                    </div>
                    <div class="form-group">
                        <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                        <textarea class="form-control" rows="5" name="description" placeholder="Enter a description of exchange" required><?php echo (isset($trade)) ? $trade->trade_description : "";?></textarea>
                      </div>
                      <div class="form-group">
                        <strong><i class="fa fa-th-list margin-r-5"></i>Category</strong>
                        <?php echo form_dropdown('category', $categories, (isset($trade) ? $trade->trade_id_category : ''), 'id="category" class="form-control" required') ?>
                      </div>
                      <strong><i class="fa fa-star margin-r-5"></i>Interests</strong>
                      <div class="form-group">
                        <a href="#"><span class="label label-danger pull-left"><i class="fa fa-gamepad"></i></span></a>
                        <a href="#"><span class="label label-success pull-left"><i class="fa fa-book"></i></span></a>
                        <a href="#"><span class="label label-info pull-left"><i class="fa fa-mobile-phone"></i></span></a>
                        <a href="#"><span class="label label-warning pull-left"><i class="fa fa-tv"></i></span></a>
                        <a href="#"><span class="label label-danger pull-left"><i class="fa fa-futbol-o"></i></span></a>
                        <a href="#"><span class="label label-success pull-left"><i class="fa fa-automobile"></i></span></a>
                        <a href="#"><span class="label label-info pull-left"><i class="fa fa-motorcycle"></i></span></a>
                      </div>
                  <br>
            <div class="form-group">
                <p><strong><i class="fa fa-file-image-o margin-r-5"></i> Images</strong></p>
               
                <input type="file" id="exampleInputFile" name="image">

                <p class="help-block">Add images for your exchange.</p>
              </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>
                </form>
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