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
                        <h3 class="box-title"><?= $itemUser->item_title ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- <img class="img-responsive pad" src="dist/img/photo2.png" alt="Photo"> -->
                        <img class="img-responsive pad" src="<?= site_url('dist/img/' . $itemUser->itempic_picture); ?>" alt="Photo">
                    </div><!-- /.box-body -->
                    <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                    <div class="box-body">
                        <ul><li><?= $itemUser->item_description ?></li></ul>
                    </div>
                    <!-- <button type="button" class="btn btn-block btn-primary btn-flat" >More info</button> -->
                    <a class="btn btn-block btn-primary btn-flat" target="_blank" href="<?= site_url('Item/itemDetails/' . $itemUser->item_id) ?>">More info</a>
                </div><!-- /.box -->
            </div>
            <div class="col-md-4">
                <a class="btn btn-block btn-success btn-flat" href="<?= site_url('Trade/responseOffer/1/'.$idTrade) ?>" style="margin-top: 375px;">Accept the offer</a>
                <a class="btn btn-block btn-danger btn-flat"  href="<?= site_url('Trade/responseOffer/2/'.$idTrade) ?>">Decline the offer</a>
            </div>
            <div class="col-md-4 pull-right" style="min-height: 500px;">
                <h3>What the user offered...</h3>
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?= $itemOffered->item_title ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- <img class="img-responsive pad" src="dist/img/photo2.png" alt="Photo"> -->
                        <img class="img-responsive pad" src="<?= site_url('dist/img/' . $itemOffered->itempic_picture); ?>" alt="Photo">
                    </div><!-- /.box-body -->
                    <strong><i class="fa fa-th-list margin-r-5" style="margin-left:20px;"></i>Description</strong>
                    <div class="box-body">
                        <ul><li><?= $itemOffered->item_description ?></li></ul>
                    </div>
                    <!-- <button type="button" class="btn btn-block btn-primary btn-flat" >More info</button> -->
                    <a class="btn btn-block btn-primary btn-flat" target="_blank" href="<?= site_url('Item/itemDetails/' . $itemOffered->item_id . '/1') ?>">More info</a>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>