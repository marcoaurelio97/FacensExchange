<?php $this->load->view('header') ?>

<style>
    #fotinho img {
        width:250px;
        height:200px;
    }

    #seta img {
        width:100px;
        height:70px;
        margin-top: 100px;
        margin-left: 10px;
    }
</style>

<div class="content-wrapper">
    <?php echo $this->session->userdata('item'); ?>
    <?= $title ?>
    <?php if(isset($tradesCurrent)): ?>
        <section class="content-header">
        <h1>Current Trades</h1>
        </section>
        <section class="content">
            <div class="row">
                <?php foreach($tradesCurrent AS $row): ?>
                    <div class="col-md-8 col-md-offset-2" style="min-height: 300px;">
                        <div class="box box-solid box-primary">
                            <div class="box-body">
                                <div class="col-md-5">
                                    <h3 class="box-title text-center"><?= $row['left']->item_title ?></h3>
                                    <div class="text-center" id="fotinho">
                                        <?php if ($row['left']->itempic_picture) : ?>
                                            <img src="<?= site_url('dist/img/' . $row['left']->itempic_picture); ?>" alt="Photo">
                                        <?php else : ?>
                                            <img src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-2" id="seta">
                                    <img src="<?= site_url('dist/img/seta_'.$row['arrow'].'.png'); ?>" alt="Photo">
                                    <?php if ($row['rec']) : ?>
                                        <div class="btn-group" style="margin-top:20px;">
                                            <a class="btn btn-success btn-flat" href="<?= site_url('Trade/responseOffer/1/'.$row['trade']->trade_id) ?>">Accept</a>
                                            <a class="btn btn-danger btn-flat"  href="<?= site_url('Trade/responseOffer/2/'.$row['trade']->trade_id) ?>">Decline</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-5">
                                    <h3 class="box-title text-center"><?= $row['right']->item_title ?></h3>
                                    <div class="text-center" id="fotinho">
                                        <?php if ($row['right']->itempic_picture) : ?>
                                            <img src="<?= site_url('dist/img/' . $row['right']->itempic_picture); ?>" alt="Photo">
                                        <?php else : ?>
                                            <img src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if(isset($tradesFinalized)): ?>
    <section class="content-header">
    <h1>Finalized Trades</h1>
    </section>
    <section class="content">
        <div class="row">
                <?php foreach($tradesFinalized AS $row): ?>
                    <div class="col-md-8 col-md-offset-2" style="min-height: 300px;">
                        <div class="box box-solid box-primary">
                            <div class="box-body">
                                <div class="col-md-5">
                                    <h3 class="box-title text-center"><?= $row['left']->item_title ?></h3>
                                    <div class="text-center" id="fotinho">
                                        <?php if ($row['left']->itempic_picture) : ?>
                                            <img src="<?= site_url('dist/img/' . $row['left']->itempic_picture); ?>" alt="Photo">
                                        <?php else : ?>
                                            <img src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-2" id="seta">
                                    <img src="<?= site_url('dist/img/seta_'.$row['arrow'].'.png'); ?>" alt="Photo">
                                </div>
                                <div class="col-md-5">
                                    <h3 class="box-title text-center"><?= $row['right']->item_title ?></h3>
                                    <div class="text-center" id="fotinho">
                                        <?php if ($row['right']->itempic_picture) : ?>
                                            <img src="<?= site_url('dist/img/' . $row['right']->itempic_picture); ?>" alt="Photo">
                                        <?php else : ?>
                                            <img src="<?= site_url('dist/img/default_trade.png'); ?>" alt="Photo">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if (!isset($tradesCurrent) && !isset($tradesFinalized)) : ?>
        <br>
        <div class="container">
            <div class='alert alert-info alert-dismissible'>
                You don't have any trade
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>