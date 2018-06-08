<?php $this->load->view('header') ?>

<style>
  #fotinho img {
      width:250px;
      height:200px;
  }
</style>

<div class="content-wrapper">
    <?php if($tradesCurrent): ?>
    <section class="content-header">
    <h1>Current Exchanges</h1>
    </section>
    <section class="content">
        <?php echo $this->session->userdata('item'); ?>
        <div class="row">
                <?php foreach($tradesCurrent AS $row): ?>
                    <div class="col-md-4" style="min-height: 500px;">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?= $row->trade_title ?></h3>
                            </div>
                            <div class="box-body">
                                <div class="text-right">
                                    <div class="btn-group">
                                        <a class="btn btn-warning btn-flat" href="<?= site_url('Exchange/editTrade/'.$row->trade_id) ?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-flat" href="<?= site_url('Exchange/deleteTrade/'.$row->trade_id) ?>"><i class="fa fa-fw fa-trash"></i></a>
                                    </div>
                                </div>
                                <div class="text-center" id="fotinho">
                                    <?php if ($row->trade_pic_picture) : ?>
                                        <img src="<?= site_url('dist/img/' . $row->trade_pic_picture); ?>" alt="Photo">
                                    <?php else : ?>
                                        <img src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                    <?php endif; ?>
                                </div>
                                    <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                                    <ul>
                                        <li><?= $row->trade_description ?></li>
                                    </ul>
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
                            <a class="btn btn-block btn-primary btn-flat" href="<?= site_url('Exchange/tradeDetails/'.$row->trade_id.'/TRUE') ?>">More info</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if($tradesFinalized): ?>
    <section class="content-header">
    <h1>Finalized Exchanges</h1>
    </section>
    <section class="content">
        <div class="row">
                <?php foreach($tradesFinalized AS $row): ?>
                    <div class="col-md-4" style="min-height: 500px;">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?= $row->trade_title ?></h3>
                            </div>
                            <div class="box-body">
                                <div class="text-center" id="fotinho">
                                    <?php if ($row->trade_pic_picture) : ?>
                                        <img src="<?= site_url('dist/img/' . $row->trade_pic_picture); ?>" alt="Photo">
                                    <?php else : ?>
                                        <img src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                    <?php endif; ?>
                                </div>
                            <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                                <ul>
                                    <li><?= $row->trade_description ?></li>
                                </ul>
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
                        <a class="btn btn-block btn-primary btn-flat" href="<?= site_url('Exchange/tradeDetails/'.$row->trade_id.'/FALSE') ?>">More info</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>        
    <?php endif; ?>
    <?php if (!$tradesCurrent && !$tradesFinalized) : ?>
        <br>
        <div class="container">
            <div class='alert alert-info alert-dismissible'>
                You don't have any current trade
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>