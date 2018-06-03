<?php $this->load->view('header') ?>

<style>
  #fotinho img {
      width:250px;
      height:200px;
  }
</style>

<div class="content-wrapper">
    <section class="content-header">
    <h1>Current Exchanges</h1>
    </section>
    <section class="content">
        <?php echo $this->session->userdata('item'); ?>
        <div class="row">
            <?php if($tradesCurrent): ?>
                <?php foreach($tradesCurrent AS $row): ?>
                    <div class="col-md-4" style="min-height: 500px;">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?= $row->trade_title ?></h3>
                            </div>
                            <div class="box-body">
                                <div class="container" id="fotinho">
                                    <?php if ($row->trade_pic_picture) : ?>
                                        <img class="img-responsive pad" src="<?= site_url('dist/img/' . $row->trade_pic_picture); ?>" alt="Photo">
                                    <?php else : ?>
                                        <img class="img-responsive pad" src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                            <div class="box-body">
                                <ul>
                                    <li><?= $row->trade_description ?></li>
                                </ul>
                            </div>
                            <div class="box-body"  style="margin-left:10px;">
                                <strong><i class="fa fa-pencil margin-r-5" ></i>Interests</strong>
                                <p>
                                    <span class="label label-danger"><i class="fa fa-gamepad"></i></span>
                                    <span class="label label-success"><i class="fa fa-book"></i></span>
                                    <span class="label label-info"><i class="fa fa-mobile-phone"></i></span>
                                    <span class="label label-warning"><i class="fa fa-tv "></i></span>
                                </p>
                            </div>

                        <a class="btn btn-block btn-danger btn-flat" href="<?= site_url('Exchange/deleteTrade/'.$row->trade_id) ?>">Delete</a>
                        <a class="btn btn-block btn-warning btn-flat" href="<?= site_url('Exchange/editTrade/'.$row->trade_id) ?>">Edit</a>
                        <a class="btn btn-block btn-primary btn-flat" href="<?= site_url('Exchange/tradeDetails/'.$row->trade_id.'/TRUE') ?>">More info</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="container">
                    <div class="row">
                    <p>You don't have any current trade</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section class="content-header">
    <h1>Finalized Exchanges</h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if($tradesFinalized): ?>
                <?php foreach($tradesFinalized AS $row): ?>
                    <div class="col-md-4" style="min-height: 500px;">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?= $row->trade_title ?></h3>
                            </div>
                            <div class="box-body">
                                <div class="container" id="fotinho">
                                    <?php if ($row->trade_pic_picture) : ?>
                                        <img class="img-responsive pad" src="<?= site_url('dist/img/' . $row->trade_pic_picture); ?>" alt="Photo">
                                    <?php else : ?>
                                        <img class="img-responsive pad" src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                            <div class="box-body">
                                <ul>
                                    <li><?= $row->trade_description ?></li>
                                </ul>
                            </div>
                            <div class="box-body"  style="margin-left:10px;">
                                <strong><i class="fa fa-pencil margin-r-5" ></i>Interests</strong>
                                <p>
                                    <span class="label label-danger"><i class="fa fa-gamepad"></i></span>
                                    <span class="label label-success"><i class="fa fa-book"></i></span>
                                    <span class="label label-info"><i class="fa fa-mobile-phone"></i></span>
                                    <span class="label label-warning"><i class="fa fa-tv "></i></span>
                                </p>
                            </div>

                        <a class="btn btn-block btn-primary btn-flat" href="<?= site_url('Exchange/tradeDetails/'.$row->trade_id.'/FALSE') ?>">More info</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="container">
                    <div class="row">
                    <p>You don't have any finalized trade</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>        
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>