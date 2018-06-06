<?php $this->load->view('header') ?>

<style>
.fancy-checkbox input[type="checkbox"],
.fancy-checkbox .checked {
    display: none;
}
 
.fancy-checkbox input[type="checkbox"]:checked ~ .checked
{
    /* display: inline-block; */
    color: blue;
}
 
.fancy-checkbox input[type="checkbox"]:checked ~ .unchecked
{
    /* display: none; */
    color: red;
    font-size: 1.5em;    
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= isset($add) ? 'Add Exchange' : 'Edit Exchange' ?></h1>
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
                <form action="<?= $actionForm ?>" method="post" enctype="multipart/form-data">                
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
                      <?php if($wishes):?>
                        <div class="form-group">
                        <strong><i class="fa fa-pencil margin-r-5"></i>Interests</strong>
                            <p>
                              <?php
                              $id = 0;
                              foreach($wishes AS $row):?>
                              <label class="fancy-checkbox">
                                <input type="checkbox" name="wishes[]"  value="<?=$id?>"></input>
                                  <i class="<?=$row->typ_class?> unchecked" data-toggle="tooltip" title="<?=$row->typ_name?>"></i>
                                  <i class="<?=$row->typ_class?> checked" data-toggle="tooltip" title="<?=$row->typ_name?>"></i>
                              </label>
                              <?php
                              $id++;
                              endforeach;?>
                            </p>             
                      <?php endif;?>
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
                    <button type="submit" class="btn btn-primary pull-right"><?= isset($add) ? 'Submit' : 'Edit' ?></button>
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

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>