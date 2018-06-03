<?php $this->load->view('header') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Home</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?= $this->session->userdata('item'); ?>
        <div class="row">
            <div class="col-md-4" style="min-height: 500px;">
                <h3>What you have...</h3>
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?= $tradeHave->trade_title ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- <img class="img-responsive pad" src="dist/img/photo2.png" alt="Photo"> -->
                        <img class="img-responsive pad" src="<?= site_url('dist/img/' . $tradeHave->trade_pic_picture); ?>" alt="Photo">
                    </div><!-- /.box-body -->
                    <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                    <div class="box-body">
                        <ul><li><?= $tradeHave->trade_description ?></li></ul>
                    </div>
                    <!-- <button type="button" class="btn btn-block btn-primary btn-flat" >More info</button> -->
                    <a class="btn btn-block btn-primary btn-flat" target="_blank" href="<?= site_url('Exchange/tradeDetails/' . $tradeHave->trade_id) ?>">More info</a>
                </div><!-- /.box -->
            </div>
            <div class="col-md-4">
                <a class="btn btn-block btn-success btn-flat" href="<?= site_url('Exchange/responseOffer/1/'.$idTradeOffer) ?>" style="margin-top: 375px;">Accept the offer</a>
                <a class="btn btn-block btn-danger btn-flat"  href="<?= site_url('Exchange/responseOffer/2/'.$idTradeOffer) ?>">Decline the offer</a>
            </div>
            <div class="col-md-4 pull-right" style="min-height: 500px;">
                <h3>What the user wants...</h3>
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?= $tradeWant->trade_title ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- <img class="img-responsive pad" src="dist/img/photo2.png" alt="Photo"> -->
                        <img class="img-responsive pad" src="<?= site_url('dist/img/' . $tradeWant->trade_pic_picture); ?>" alt="Photo">
                    </div><!-- /.box-body -->
                    <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                    <div class="box-body">
                        <ul><li><?= $tradeWant->trade_description ?></li></ul>
                    </div>
                    <!-- <button type="button" class="btn btn-block btn-primary btn-flat" >More info</button> -->
                    <a class="btn btn-block btn-primary btn-flat" target="_blank" href="<?= site_url('Exchange/tradeDetails/' . $tradeWant->trade_id . '/1') ?>">More info</a>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>