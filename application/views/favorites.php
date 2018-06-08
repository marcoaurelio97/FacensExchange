<?php $this->load->view('header') ?>

<div class="content-wrapper">
    <section class="content-header">
      <h1>Favorites</h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if($favUsers): ?>
                    <?php foreach($favUsers AS $row): ?>
                        <div class="col-md-4">
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        <?= $row->pro_name ?>
                                    </h3>
                                </div>                               
                                <div class="box-body">
                                    <div class="text-center">
                                        <img src="<?= site_url((isset($row->pro_picture)) ? 'dist/img/'.$row->pro_picture : 'dist/img/user-default.jpg') ?>" class="img-circle img-responsive" alt="avatar" width="150px" height="150px"> 
                                    </div>
                                    <a class="btn btn-block btn-info btn-flat" href="<?= site_url('Profile/viewProfile/'.$row->pro_id) ?>"><i class="fa fa-commenting-o"></i> See <?= $row->pro_name?> Profile</a>                                        
                                </div>
                            </div>
                        </div>                        
                    <?php endforeach;
                else:  ?>             
                    <p>No favorites were.</p>               
                <?php endif; ?>  
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer') ?>
