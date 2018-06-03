<?php $this->load->view('header') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Comments</h1>
    </section>
    <div class="content">
            
        <div class="row">
			<div class="col-sm-7">
				<hr/>
				<div class="review-block">
                    <?php if($comments):?>
                        <?php foreach($comments AS $row):?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <!-- <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded"> -->
                                    <img src="<?= site_url((isset($row->pro_picture)) ? 'dist/img/'.$row->pro_picture : 'dist/img/user-default.jpg') ?>" class="img-rounded" height="100px" width="100px">
                                    
                                    <div class="review-block-name"><a href="#"><?=$row->user_username?></a></div>
                                </div>
                                    <?php for($i=0;$i<$row->rat_rating;$i++):?>
                                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                    <?php endfor;?>
                                    <?php for($i = 0; $i < 5-$row->rat_rating; $i++):?>
                                        <button type="button" class="btn btn-danger btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                    <?php endfor;?>

                                    <!-- <div class="review-block-title"><?= $row->rat_rating?></div> -->
                                    <br>
                                    <div class="review-block-description"><?= $row->rat_comments?></div>
                                </div>
                            </div>
                            <hr/>
                        <?php endforeach;?>
                    <?php endif;?>                        
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer') ?>