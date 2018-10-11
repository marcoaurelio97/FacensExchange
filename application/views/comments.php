<?php $this->load->view('header') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Comments</h1>
    </section>
    <div class="content">
            
        <div class="row">
            <?php if($comments):?>
                <?php foreach($comments AS $row):?>
                    <div class="col-md-6" style="margin-top:20px;">
                        <div class="col-md-4">
                            <img src="<?= site_url((isset($row->pro_picture)) ? 'dist/img/'.$row->pro_picture : 'dist/img/user-default.jpg') ?>" class="img-rounded" height="100px" width="100px">
                            
                            <div class="review-block-name"><a href="#"><?=$row->user_username?></a></div>
                        </div>
                        <div class="col-md-8">
                            <div>
                                <?php for($i=0;$i<$row->rat_rating;$i++):?>
                                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align" disabled>
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php endfor;?>
                                <?php for($i = 0; $i < 5-$row->rat_rating; $i++):?>
                                    <button type="button" class="btn btn-default btn-sm" aria-label="Left Align" disabled>
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                <?php endfor;?>
                            </div>
                            <br>
                            <div class="review-block-description"><?= $row->rat_comments?></div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>                        
        </div>
    </div>
</div>
<?php $this->load->view('footer') ?>