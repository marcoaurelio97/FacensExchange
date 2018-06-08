<?php $this->load->view('header') ?>

<div class="content-wrapper">
    <section class="content-header">
      <h1><?= $title ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            
                <!-- left column -->
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="<?= site_url((isset($profile->pro_picture)) ? 'dist/img/'.$profile->pro_picture : 'dist/img/user-default.jpg') ?>" class="avatar img-circle" alt="avatar" height="100" width="100">
                        
                        <h6>Upload a different photo...</h6>
                        
                        <input type="file" id="exampleInputFile" name="image">
                    </div>
                </div>
        
                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a> 
                        <i class="fa fa-coffee"></i>
                        Tell us a little more about you...
                    </div>
                    <h3>Personal info</h3>
                
                    <!-- <form class="form-horizontal" method="post" action=""> -->
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Name:</label>
                        <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->pro_name : ''?>" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Date of birth:</label>
                        <div class="col-lg-8">
                        <input class="form-control" id="date" type="text" value="<?php echo (isset($profile)) ? $profile->pro_date_of_birth : ''?>" name="birth">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">RG:</label>
                        <div class="col-lg-8">
                        <input class="form-control" id="rg" type="text" value="<?php echo (isset($profile)) ? $profile->pro_rg : ''?>" name="rg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">CPF:</label>
                        <div class="col-lg-8">
                        <input class="form-control" id="cpf" type="text" value="<?php echo (isset($profile)) ? $profile->pro_cpf : ''?>" name="cpf">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Street:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_street : ''?>" name="street">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Number:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_number : ''?>" name="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Complement:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_complement : ''?>" name="complement">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Zip Code:</label>
                        <div class="col-md-8">
                        <input class="form-control" id="zip" type="text" value="<?php echo (isset($profile)) ? $profile->address_zip_code : ''?>" name="zipCode">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">City:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_city : ''?>" name="city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Neighborhood:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_neighborhood : ''?>" name="neighborhood">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">UF:</label>
                        <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_uf_state : ''?>" name="uf">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Telephone:</label>
                        <div class="col-md-8">
                        <input class="form-control" id="tel" type="text" value="<?php echo (isset($profile)) ? $profile->tel_telephone : ''?>" name="telephone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->load->view('footer') ?>

<script>
    $(document).ready(function(){
        $('#tel').mask('(99) 99999-9999');
        $('#date').mask('99/99/9999');
        $('#cpf').mask('999.999.999-99');
        $('#zip').mask('99999-999');
    });
</script>