<?php $this->load->view('header') ?>

<div class="content-wrapper">
    <section class="content">
        <?php echo $this->session->userdata('item'); ?>
        <h3>What you want...</h3>
            <div class="box box-solid box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= $trade->trade_title ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <span class="label label-default"><i class="fa fa-fw fa-clock-o"></i><?= date('d/m/Y H:i:s', strtotime($trade->trade_date_add)) ?></span>
                    </div>
                </div>
                <div class="box-body">
                    <?= $trade->trade_description ?>
                    <a class="btn btn-default pull-right" target="_blank" href="<?= site_url('Exchange/tradeDetails/' . $trade->trade_id) ?>">More info</a>
                </div>
            </div>
            <h3>What you have to offer...</h3>
            <?php if ($myTrades) : ?>
                <?php foreach ($myTrades as $row) : ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?= $row->trade_title ?>
                            </h3>
                            <div class="box-tools pull-right">
                                <span class="label label-primary"><i class="fa fa-fw fa-clock-o"></i><?= date('d/m/Y H:i:s', strtotime($row->trade_date_add)) ?></span>
                            </div>
                        </div>
                        <div class="box-body">
                            <?= $row->trade_description ?>
                            <a class="btn btn-success pull-right" href="<?= site_url('Exchange/sendOffer/' . $trade->trade_id . '/' . $row->trade_id) ?>" style="margin-left:3px;">Send offer</a>
                            <a class="btn btn-primary pull-right" target="_blank" href="<?= site_url('Exchange/tradeDetails/' . $row->trade_id) ?>">More info</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="container">
                    <div class="row">
                    <p>You don't have any trade</p>
                    </div>
                </div>
            <?php endif; ?>
    </section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>