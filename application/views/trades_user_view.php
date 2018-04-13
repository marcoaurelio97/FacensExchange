<?php $this->load->view('header') ?>

<div class="content-wrapper">
    <section class="content-header">
    <h1>
        Exchanges
    </h1>
    </section>
    <section class="content">
        <?php echo $this->session->userdata('item'); ?>
        <div>
            <?php if($trades): ?>
                <?php foreach($trades AS $row): ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?= $row->trade_title ?>
                                <!-- <img class="img-responsive pad" src="<?= site_url('dist/img/'.$row->trade_pic_picture); ?>" alt="Photo" height="100" width="100"> -->
                            </h3>
                            <div class="box-tools pull-right">
                                <span class="label label-primary"><i class="fa fa-fw fa-clock-o"></i><?= date('d/m/Y H:i:s', strtotime($row->trade_date_add)) ?></span>
                            </div>
                        </div>
                        <div class="box-body">
                            <?= $row->trade_description ?>
                            <a class="btn btn-primary pull-right" href="<?= site_url('Exchange/tradeDetails/'.$row->trade_id) ?>">More info</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="container">
                    <div class="row">
                    <p>You don't have any trade</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>