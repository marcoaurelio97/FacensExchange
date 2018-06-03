<?php $this->load->view('header') ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $title ?></h1>
    </section>
    <div class="content">
            <div class="row">
                <div class="col-md-12" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $profile->user_username?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4" align="center"> 
                                    <!-- <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div> -->
                                    <img src="<?= site_url((isset($profile->pro_picture)) ? 'dist/img/'.$profile->pro_picture : 'dist/img/user-default.jpg') ?>" class="img-circle img-responsive" alt="avatar" width="150px" height="150px"> 
                                
                                    <div class="col-sm-">
                                        <div class="rating-block">
                                            <h4>Average user rating</h4>
                                            <h2 class="bold padding-bottom-7"><?= number_format($profile->pro_rating,1) ?> <small>/ 5</small></h2>
                                            <?php for($i=0;$i<$roundRating;$i++):?>
                                                <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                </button>
                                            <?php endfor;?>
                                            <?php for($i = 0; $i < 5-$roundRating; $i++):?>
                                                <button type="button" class="btn btn-danger btn-sm" aria-label="Left Align">
                                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                </button>
                                            <?php endfor;?>
                                            <!-- <div class="rating">
                                                <span class="glyphicon <?=$roundRating['1']?>" id="1"></span>
                                                <span class="glyphicon <?=$roundRating['2']?>" id="2"></span>
                                                <span class="glyphicon <?=$roundRating['3']?>" id="3"></span>
                                                <span class="glyphicon <?=$roundRating['4']?>" id="4"></span>
                                                <span class="glyphicon <?=$roundRating['5']?>" id="5"></span>
                                            </div> -->
                                            <div>
                                                <span class="glyphicon glyphicon-user"></span>&nbsp;<?= $profile->pro_number_of_evaluations ?>
                                            </div>
                                            <div>                                            
                                                <a href="<?= site_url('Profile/comments/'.$profile->pro_id) ?>" class="btn btn-primary btn-xs">Comments</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>              

                                <div class=" col-md-8"> 
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td><?= $profile->pro_name?></td>
                                        </tr>
                                        <tr>
                                            <td>Street:</td>
                                            <td><?= $profile->address_street?></td>
                                        </tr>
                                        <tr>
                                            <td>Number:</td>
                                            <td><?= $profile->address_number?></td>
                                        </tr>
                                            <tr>
                                            <td>Neighborhood</td>
                                            <td><?= $profile->address_neighborhood?></td>
                                        </tr>
                                        </tr>
                                            <tr>
                                            <td>City/UF:</td>
                                            <td><?= $profile->address_city.'/'.$profile->address_uf_state?></td>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= $profile->user_email?></td>
                                        </tr>
                                            <td>Phone Number</td>
                                            <td><?= $profile->tel_telephone?></td>                           
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="panel-footer">
                                        <span class="pull-right">
                                        <a href="#" class="btn btn-primary">Add to favorites</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
    </div>
</div>
<?php $this->load->view('footer') ?>