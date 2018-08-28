<?php $this->load->view('header') ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?= $title ?></h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h2 class="box-title"><strong>Tell us what happened</strong></h2>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">                
                            <div class="box-body">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                    <strong><i class="fa fa-edit margin-r-5"></i>Title</strong>
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $item->item_title ?>" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <strong><i class="fa fa-th-list margin-r-5"></i>Motive</strong>
                                        <?php echo form_dropdown('motive', $motives, $motive, 'id="motive" class="form-control" required') ?>
                                    </div>
                                    <div class="form-group">
                                        <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
                                        <textarea class="form-control" rows="5" name="description" placeholder="Describe what happened" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->load->view('footer') ?>