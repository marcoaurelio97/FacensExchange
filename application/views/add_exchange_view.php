<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Exchange
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
                    <h2 class="box-title"><strong>Exchange Infos</strong></h2>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                    <div class="form-group">
                        <strong><i class="fa fa-edit margin-r-5"></i>Title</strong>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter a title of exchange">
                    </div>
                    <div class="form-group">
                        <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                        <textarea class="form-control" rows="5" placeholder="Enter a description of exchange"></textarea>
                      </div>

                      <strong><i class="fa fa-star margin-r-5"></i>Interests</strong>
                      <div class="form-group">
                            <label>
                              <span class="label label-danger pull-left"><i class="fa fa-gamepad"></i></span>                             
                            </label>
                            <label>                               
                              <span class="label label-success pull-left"><i class="fa fa-book "></i></span>                          
                            </label>
                            <label>                                
                              <span class="label label-info pull-left"><i class="fa fa-mobile-phone"></i></span>                          
                            </label>
                            <label>                               
                              <span class="label label-warning pull-left"><i class="fa fa-tv "></i></span>                           
                            </label>
                            <label>                               
                              <span class="label label-danger pull-left"><i class="fa fa-futbol-o "></i></span>                           
                            </label>
                            <label>                               
                              <span class="label label-success pull-left"><i class="fa fa-automobile  "></i></span>                           
                            </label>
                            <label>                               
                              <span class="label label-info pull-left"><i class="fa fa-motorcycle "></i></span>                           
                            </label>
                     
            </div>

            <div class="form-group">
                <p><strong><i class="fa fa-file-image-o margin-r-5"></i> Images</strong></p>
               
                <input type="file" id="exampleInputFile">

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