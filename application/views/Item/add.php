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
<div class="content-wrapper">
  <?= $this->session->userdata('item'); ?>
  <section class="content-header">
      <h1><?= isset($add) ? 'Add Item' : 'Edit Item' ?></h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2 class="box-title"><strong>Item Infos</strong></h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data">                
              <div class="box-body">
                <div class="form-group">
                  <strong><i class="fa fa-edit margin-r-5"></i>Title</strong>
                  <input type="text" class="form-control" name="title" id="title" value="<?php echo (isset($item)) ? $item->item_title : "";?>" placeholder="Enter a title of Item" required>
                  <?php echo form_error('title'); ?>
                </div>
                <div class="form-group">
                  <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                  <textarea class="form-control" rows="5" name="description" placeholder="Enter a description of Item" required><?php echo (isset($item)) ? $item->item_description : "";?></textarea>
                  <?php echo form_error('description'); ?>
                </div>
                <div class="form-group">
                  <strong><i class="fa fa-th-list margin-r-5"></i>Category</strong>
                  <?php echo form_dropdown('category', $categories, (isset($item) ? $item->item_idcategory : ''), 'id="category" class="form-control" required') ?>
                  <?php echo form_error('category'); ?>                    
                </div>
                  <?php if($wishes):?>
                    <div class="form-group">
                    <strong><i class="fa fa-pencil margin-r-5"></i>Interests</strong>
                        <p>
                          <?php
                          foreach($wishes AS $row):?>
                          <label class="fancy-checkbox">
                              <input type="checkbox" name="wishes[]"  value="<?=$row->typ_id?>" <?php if(isset($wishesItem[$row->typ_id])){ echo 'checked'; }?>>
                              <i class="<?=$row->typ_class?> unchecked" data-toggle="tooltip" title="<?=$row->typ_name?>"></i>
                              <i class="<?=$row->typ_class?> checked" data-toggle="tooltip" title="<?=$row->typ_name?>"></i>
                          </label>
                          <?php
                          endforeach;?>
                          <?php echo form_error('wishes'); ?>                    
                        </p>             
                  <?php endif;?>
                </div>
              <br>
              <div class="form-group">
                <p><strong><i class="fa fa-file-image-o margin-r-5"></i> Images</strong></p>
                
                <input type="file" id="exampleInputFile" name="image">

                <p class="help-block">Add images for your Item.</p>
              </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?= isset($add) ? 'Submit' : 'Edit' ?></button>
              </div>
            </form>
          </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('footer') ?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>