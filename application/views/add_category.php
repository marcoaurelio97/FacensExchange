<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Category
        <small>Facens Exchange</small>
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
                    <h2 class="box-title"><strong>Category</strong></h2>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="<?= site_url('Add_category/addCategories') ?>" method="post">                
                  <div class="box-body">
                    <div class="form-group">
                      <strong><i class="fa fa-edit margin-r-5"></i>Name</strong>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter a category name" required>
                    </div>
                    <div class="form-group">
                        <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                        <textarea class="form-control" rows="5" name="description" placeholder="Enter a description of category" required></textarea>
                      </div>                     
                  <br>
            
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