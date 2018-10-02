<?php $this->load->view('header') ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Item Details
      </h1>
    </section>

    <section class="content">
     
      <div class="row">
        <!-- IMAGEM -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
                <img class="img-responsive pad" src="<?= site_url('dist/img/' . $item->itempic_picture) ?>" alt="Photo">
            </div>
            <div class="box-body">
                <div>
                    <div style="float:left;margin-right:10px;margin-left:25px;" >
                        <img src="<?= site_url('dist/img/' . $item->itempic_picture) ?>" height="100" width="100"  />
                    </div>
                </div>
              </div>
          </div>
        </div>
        <!-- INFORMAÇÕES ITEM -->
        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <div >               
                      <h1><strong><?= $item->item_title; ?></strong></h1>
                      <h6 class="description-header">Published - <i class="fa fa-fw fa-clock-o"></i><?= date('d/m/Y', strtotime($item->item_date_add)); ?></h6>
                </div>              
              </div>
            <div class="box-body">
              <strong><i class="fa fa-th margin-r-5"></i>Category</strong>
              <div class="box-body">
                  <ul>
                    <li><?= $item->category_name; ?></li>
                  </ul>
                </div>
              <strong><i class="fa fa-th-list margin-r-5"></i>Description</strong>
              <div class="box-body">
                  <ul>
                    <li><?= $item->item_description; ?></li>
                  </ul>
                </div>

              <?php if($wishes):?>
              <strong><i class="fa fa-pencil margin-r-5"></i>Interests</strong>
                <p>
                  <?php foreach($wishes AS $row):?>
                    <i class="<?=$row->typ_class?>" data-toggle="tooltip" title="<?=$row->typ_name?>"></i>
                  <?php endforeach;?>
                </p>              
              <?php endif;?>                                          

              <?php if (($profileItem != $profileLogged) && (!is_null($profileLogged))) : ?>
                <hr>
                <div class="row no-print">
                  <div class="col-xs-12">                   
                    <a class="btn btn-success btn-lg btn-flat" href="<?= site_url('Trade/makeAnOffer/'.$item->item_id) ?>"><i class="fa fa-exchange"></i> Exchange</a>
                    <a class="btn btn-primary btn-lg btn-flat" href="#"><i class="fa fa-commenting-o"></i> Contact</a>
                    <a class="btn btn-info btn-lg btn-flat" href="<?= site_url('Profile/viewProfile/'.$profileItem) ?>"><i class="fa fa-commenting-o"></i> See <?= $item->user_username?> Profile</a>                    
                    <a class="btn btn-danger btn-lg btn-flat" href="<?= site_url('Item/Report/'.$item->item_id) ?>"><i class="fa fa-commenting-o"></i> Report Item</a>                                      
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <!-- CHAT -->
          <?php if($this->session->userdata('logged')): ?>
            <div class="row">
              <div class="col-md-12">
                <div class="box box-primary direct-chat direct-chat-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Public chat about this Item</h3>
                  </div>
                  <div class="box-body">
                  <div class="overlay">
                    <i class="fa fa-refresh fa-spin"></i>
                  </div>
                  <div class="direct-chat-messages" id="chatDaMassa"></div>
                  </div>
                  <div class="box-footer">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control" id="msg">
                          <span class="input-group-btn">
                            <button type="button" id="sendMessage" class="btn btn-primary btn-flat">Send</button>
                          </span>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        <?php endif;?>
      </div>
    </section>
  </div>

<?php $this->load->view('footer') ?>

<script>
  $(function(){
    if(<?= $this->session->userdata('logged') ?>){
      $.ajax({
        url: '<?= base_url('Item/getMessagesChat/'.$item->item_id.'/'.$profileLogged)?>',
        success: function( response ){
          $('.overlay').hide();
          data = JSON.parse(response);
          $('#chatDaMassa').html('');
          $.each(data,function(index){
            var lado = (data[index].side == 'R') ? 'right' : '';
            $('#chatDaMassa').append(
              '<div class="direct-chat-msg ' + lado + '">'                                          +
                '<div class="direct-chat-info clearfix">'                                           +
                  '<span class="direct-chat-name pull-left">'+ data[index].username + '</span>'     +
                  '<span class="direct-chat-timestamp pull-right">' + data[index].time + '</span>'  +
                '</div>'                                                                            +
                '<div class="direct-chat-text">'                                                    +
                  data[index].message                                                               +
                '</div>'                                                                            +
              '</div>'
            );
          });
        }
      });

      $('#sendMessage').on('click',addMessage);
    }
  });

  function addMessage(){
    var message = $('#msg').val();
    $('#msg').val('');
    $.ajax({
      type: 'POST',
      url: '<?= base_url('Item/newMessage/'.$item->item_id)?>',
      data:{
            message : message
      },
      beforeSend: function() {
        $('.overlay').show();
      },
      success: function( response ){
        $('.overlay').hide();
        data = JSON.parse(response);
        var lado = (data.side == 'R') ? 'right' : '';
        $('#chatDaMassa').append(
          '<div class="direct-chat-msg ' + lado + '">'                                  +
            '<div class="direct-chat-info clearfix">'                                   +
              '<span class="direct-chat-name pull-left">'+ data.username + '</span>'    +
              '<span class="direct-chat-timestamp pull-right">' + data.time + '</span>' +
            '</div>'                                                                    +
            '<div class="direct-chat-text">'                                            +
              data.message                                                              +
            '</div>'                                                                    +
          '</div>'
        );
      }
    });
  }
</script>