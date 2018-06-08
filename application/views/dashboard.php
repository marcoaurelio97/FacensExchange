<?php $this->load->view('header') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Admin Dashboard
        <small>Control panel</small>
      </h1>
    </section>

<div class="content">
    <section class="content">
      <div class="row">
        <div class="col-md-4">
        
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $countTrades; ?></h3>
              <p>Trades</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            </div>          
       
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $countFinalized; ?><sup style="font-size: 20px">%</sup></h3>
              <p>Finalized Trades</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
       
        
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $countUsers; ?></h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
       
          <div class="small-box bg-red">
            <div class="inner">
              <h3>0</h3>
              <p>Reports</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
          
        </div>
        <div class="col-md-8">                
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Books</span>
              <span class="info-box-number">5,200</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
              <span class="progress-description">
                    50% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cars</span>
              <span class="info-box-number">92,050</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-laptop"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Technology</span>
              <span class="info-box-number">114,381</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-gamepad"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Games</span>
              <span class="info-box-number">163,921</span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
              <span class="progress-description">
                    40% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Exchanges</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Exchange ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="#">EX2149</a></td>
                    <td>Call of Duty IV</td>
                    <td>Game of the year | 2013</td>
                    <td><a href="#">João Pedro</a>
                    <td><span class="label label-danger">Finished</span></td>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">EX1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td>New, 2015, 3 months used</td>                   
                    <td><a href="#">Marc Silva</a>
                    <td><span class="label label-warning">Exchanging</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">EX7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td>New</td>                    
                    <td><a href="#">Glauco Todesco</a>
                    <td><span class="label label-success">To exchange</span></td>
                  </tr>                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right">View All Exchanges</a>
            </div>
            </div>
            <!-- /.box-footer -->          

    </section>
  </div>

<?php $this->load->view('footer') ?>