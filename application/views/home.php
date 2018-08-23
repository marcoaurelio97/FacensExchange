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
        <h1 class="col-md-6">Home</h1>
      </div>
    </section>

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

<script>
  $(function(){
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#start').val(start.format('YYYY-M-D'));
        $('#end').val(end.format('YYYY-M-D'));        
      }
    )
  });
</script>