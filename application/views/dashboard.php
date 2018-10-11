<?php $this->load->view('header') ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Admin Dashboard
      <small>Control panel</small>
    </h1>
  </section>

  <div class="content">
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="col-md-12">
            <div class="col-md-6">

              <!-- Itens Trocados -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $tradedItems; ?></h3>
                  <p>Traded Items</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>     
              
              <!-- Porcentagem de trocas bem sucedidas -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?= $totalTrades ? round((($acceptedTrades/($totalTrades))*100),2) : '0'; ?><sup style="font-size: 20px">%</sup></h3>
                  <p>Successful Trades</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
    
              <!-- Usuários Registrados -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?= ($userRegistrations); ?></h3>
                  <p>User registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <!-- Itens disponíveis -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><?=$pendingItems?></h3>
                  <p>Pending Itens</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>

              <!-- Quantidade de denúncias -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?=$reports?></h3>
                  <p>Reports</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>

              <!-- Trocas acontecendo -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?=$pendingTrades?></h3>
                  <p>Pending Trades</p>
                </div>
                <div class="icon">
                  <!-- <i class="fas fa-exchange-alt"></i> -->
                  <i class="ion ion-arrow-swap"></i>
                </div>
              </div>

            </div>
          </div>
        </div>
         
        <div class="col-md-6">                
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Items by Category</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Exchanges</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Trade ID</th>
                <th>User Receiver</th>
                <th>Item Receiver</th>
                <th>User Sender</th>
                <th>Item Sender</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
                <?php if($last_trades): ?>
                  <?php $count = 1;?>
                  <?php foreach($last_trades AS $row): ?>
                    <tr>
                      <td><?= $row->tradeId?></td>
                      <td><?= $row->recUser ?></td>
                      <td><?= $row->recItem ?></td>
                      <td><?= $row->senUser ?></td>
                      <td><?= $row->senItem ?></td>
                      <td>
                      <?php if($row->status == 0):?>
                        <span class="label label-warning">Pending</span>
                      <?php elseif($row->status == 1):?>
                        <span class="label label-success">Accepted</span>
                      <?php elseif($row->status == 2):?>
                        <span class="label label-danger">Declined</span>
                      <?php endif; ?>                
                      </td>  
                    </tr> 
                  <?php $count++; ?>
                  <?php endforeach ; ?>             
                <?php endif; ?>                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('footer') ?>

<script>
//DONUT CHART
  var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    // colors: ["#3c8dbc", "#f56954", "#00a65a"],
    colors: getRandomColor(),
    data: [
      <?php foreach($donutChart AS $row):?>
      {label: '<?=$row->name?>', value: <?=$row->count?>},
      <?php endforeach;?>      
    ],
    hideHover: 'auto'
  });

  function getRandomColor() {
    debugger;
    var letters = '0123456789ABCDEF';
    var quantCategorias = <?= count($donutChart); ?>;
    var array = [];

    for(var j=0; j<quantCategorias; j++){
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      array.push(color);
    }
    return array;
  }
</script>