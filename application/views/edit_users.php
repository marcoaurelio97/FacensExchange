<?php $this->load->view('header') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Edit Users</h1>
    </section>

        <!-- Main content -->
    <section class="content">
          <!-- Small boxes (Stat box) -->
      <div class="row container">
        <div class="row">
          <div class="col-xs-8">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Users</h3>
                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
          <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="table-users" class="table">
                <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>Date register</th>
                  <th>Role</th>           
                </tr>
            
                <?php $count = 1; if($users){ ?>
                  <?php foreach($users AS $row){ ?>
                    <tr>
                      <td><?=$count?></td>
                      <td><?= $row->user_username ?></td>
                      <td><?= $row->user_email ?></td>
                      <td><?= $row->user_date_add ?></td>
                      <td><span class="label label-<?php if($row->user_role == "admin"){echo "danger";}else{echo "primary";} ?>"><?= $row->user_role ?></span></td>  
                    </tr> 
                  <?php $count++;} ?>
                <?php } else { ?>             
                  <p>No users added.</p>               
                <?php } ?>  
              </table>
            </div>
          <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </div>
      </div>
          <!-- /.row -->
    </section>
        <!-- /.content -->
  </div>
<?php $this->load->view('footer') ?>

<script>
  $(document).ready(function(){
    $('#table-users').dataTable();
  });
</script>