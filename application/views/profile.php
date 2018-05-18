<?php $this->load->view('header') ?>

<div class="content-wrapper">
    <section class="content-header">
      <h1>Edit Users</h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
                    <h6>Upload a different photo...</h6>
                    
                    <input type="file" class="form-control">
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
                    
                    <form class="form-horizontal" method="post" action="<?php echo site_url('Profile/register')?>">
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
                            <input class="form-control" id="cpf" type="text" value="<?php echo (isset($profile)) ? $profile->pro_rg : ''?>" name="rg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">CPF:</label>
                            <div class="col-lg-8">
                            <input class="form-control" id="tel" type="text" value="<?php echo (isset($profile)) ? $profile->pro_cpf : ''?>" name="cpf">
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
                            <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_street : ''?>" name="number">
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
                            <input class="form-control" type="text" value="<?php echo (isset($profile)) ? $profile->address_zip_code : ''?>" name="zipCode">
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
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('footer') ?>

<script>
    $(document).ready(function(){
        $('#tel').mask('(99) 99999-9999');
        $('#rg').mask('99.999.999-9');
        $('#date').mask('99/99/9999');
        $('#cpf').mask('999.999.999-99');
    };
</script>