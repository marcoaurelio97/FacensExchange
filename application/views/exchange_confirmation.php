<?php $this->load->view('header') ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Home</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?= $this->session->userdata('item'); ?>
        <div class="row">
            <div class="col-md-12" style="min-height: 500px;">
                <h2>Rate the user <?=$userToBeRated->pro_name?></h2>
                <form action="" method="post" id="form">
                    <div class="col-lg-12">
                        <div class="star-rating">
                            <span class="fa fa-star-o" data-rating="1"></span>
                            <span class="fa fa-star-o" data-rating="2"></span>
                            <span class="fa fa-star-o" data-rating="3"></span>
                            <span class="fa fa-star-o" data-rating="4"></span>
                            <span class="fa fa-star-o" data-rating="5"></span>
                            <input type="hidden" name="rating" class="rating-value">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label for="comments">Comments:</label>
                        <textarea class="form-control" rows="5" name="comments" id="comments" placeholder="Add your comment here..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-lg-12">
                            <input type="submit" class="btn btn-success" value="Confirm">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- ./wrapper -->

<?php $this->load->view('footer') ?>

<script>
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function() {
    return $star_rating.each(function() {
        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
            return $(this).removeClass('fa-star-o').addClass('fa-star');
        } else {
            return $(this).removeClass('fa-star').addClass('fa-star-o');
        }
    });
    };

    $star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
    });

    SetRatingStar();
    $(document).ready(function() {

    });
</script>