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
                    <a class="btn btn-info btn-lg btn-flat" href="<?= site_url('Profile/viewProfile/'.$profileItem) ?>"><i class="fa fa-commenting-o"></i> See <?= $item->user_username?> Profile</a>                    
                    <a class="btn btn-danger btn-lg btn-flat" href="<?= site_url('Item/Report/'.$item->item_id) ?>"><i class="fa fa-exclamation-triangle"></i> Report Item</a>                                      
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-md-offset-2">

          <div class="nav-tabs-custom">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- NOVO CHAT -->
                <h3>Q&A Session</h3>
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post clearfix">

                    <div id="qeaSession">
                      <p>
                        <b>Welcome!</b> Here is where you can ask any questions about this item
                      </p>
                    </div>
                    <br>
                    <?php if($profileItem != $profileLogged && $this->session->userdata('logged')):?>
                      <div class="form-group margin-bottom-none">
                        <div class="col-sm-9">
                          <input class="form-control input-sm" maxlength="75" id="msg" placeholder="Type here...">
                        </div>
                        <div class="col-sm-3">
                          <button type="button" id="sendMessage" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                        </div>
                      </div>
                    <?php endif;?>
                  </div>
                </div>
              </div>
                  <!-- /.post -->
            </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('footer') ?>

<script>
  $(function(){
      var ownerItem = <?=$profileItem?>;
      var profileLogged = <?=$profileLogged?>;
      var isOwner = (ownerItem == profileLogged) ? true : false;
      var logged = (<?=$this->session->userdata('logged') ? 'true' : 'false'?>);

      $.ajax({
        url: '<?= base_url('Item/getMessagesChat/'.$item->item_id)?>',
        success: function( response ){
          if(response != ''){
            data = JSON.parse(response);
            $('#qeaSession').html('');
            $.each(data,function(index){
              if(isOwner && !data[index].replied && logged){
                reply = '<div class="form-group margin-bottom-none" id="divReply'+ data[index].idmessage +'">'                                                   +
                          '<div class="col-sm-9">'                                                                      +
                            '<input type="text" class="form-control maxlength="75" input-sm" id="msgReply'+ data[index].idmessage +'" placeholder="Reply">' +
                          '</div>'                                                                                      +
                          '<div class="col-sm-3">'                                                                      +
                            '<button type="submit" class="btn btn-danger pull-right btn-block btn-sm replyMsg" data-idmsg="'+ data[index].idmessage +'">Send</button>'    +
                          '</div>'                                                                                      +
                        '</div><br>';                                                                                       
              } else if(data[index].replied){
                reply = '<small><cite title="Reply">Reply <i class="fa fa-angle-double-right"></i>'+data[index].reply+'</cite></small>';
              } else {
                reply = '';
              }

              href = '<?= site_url('dist/img') ?>/' + data[index].profilePicture;
              hrefProfile = '<?= base_url('Profile/viewProfile') ?>/' + data[index].idProfile;

              $('#qeaSession').append(
                '<div clas="post clearfix" id="replyText'+ data[index].idmessage +'">'                                                                      +
                  '<div class="user-block">'                                                                      +
                    '<img class="img-circle img-bordered-sm" src="' + href + '" alt="User Image">'                +
                    '<span class="username">'                                                                     +
                      '<a href="' + hrefProfile + '">'+data[index].username+'</a>'                                +
                    '</span>'                                                                                     +
                    '<span class="description">'+data[index].time+'</span>'                                       +
                  '</div>'                                                                                        +
                  '<br>'                                                                                          +
                  '<p>'                                                                                           +
                    data[index].message                                                                           +
                  '</p>'                                                                                          +
                  reply                                                                                           +
                '</div>'                                                                                          +
                '<hr>'
              );
            });
            $('.replyMsg').on('click',replyMessage);
          }
        }
      });
      $('#sendMessage').on('click',addMessage);
  });

  function addMessage(){
    var ownerItem = <?=$profileItem?>;
    var profileLogged = <?=$profileLogged?>;
    var isOwner = (ownerItem == profileLogged) ? true : false;
    var logged = (<?=$this->session->userdata('logged') ? 'true' : 'false'?>);

    var message = $('#msg').val();
    if(message != ''){
    $('#msg').val('');
      $.ajax({
        type: 'POST',
        url: '<?= base_url('Item/newMessage/'.$item->item_id)?>',
        data:{
              message : message,
              idOwner : <?= $item->item_idprofile ?>
        },
        success: function( response ){
          data = JSON.parse(response);

          href = '<?= site_url('dist/img') ?>/' + data.profilePicture;
          hrefProfile = '<?= base_url('Profile/viewProfile') ?>/' + data.idProfile;

          $('#qeaSession').append(
            '<div clas="post clearfix">'                                                                      +
              '<div class="user-block">'                                                                      +
                '<img class="img-circle img-bordered-sm" src="' + href + '" alt="User Image">'                +
                '<span class="username">'                                                                     +
                  '<a href="' + hrefProfile + '">'+data.username+'</a>'                                       +
                '</span>'                                                                                     +
                '<span class="description">'+data.time+'</span>'                                              +
              '</div>'                                                                                        +
              '<br>'                                                                                          +
              '<p>'                                                                                           +
                data.message                                                                                  +
              '</p>'                                                                                          +
            '</div>'                                                                                          +
            '<hr>'
          );
        }
      });
    }
  }

  function replyMessage(){
    var idMessage = $(this).data('idmsg');
    var message = $('#msgReply'+idMessage).val();
    if(message != ''){
    $('#msgReply').val('');
      $.ajax({
        type: 'POST',
        url: '<?= base_url('Item/replyMessage')?>',
        data:{
              message : message,
              idMessage: idMessage
        },
        success: function( response ){
          data = JSON.parse(response);
          $('#replyText'+idMessage).append(
            '<small><cite title="Reply">Reply <i class="fa fa-angle-double-right"></i>'+data.reply+'</cite></small>'
          );
          $('#divReply'+idMessage).hide();
        }
      });
    }
  }
</script>