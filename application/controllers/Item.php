<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_itens','itens');
        $this->load->model('model_reports','reports');
        $this->load->model('model_notifications', 'notifications');
        $this->load->model('model_profiles', 'profiles');
        $this->load->model('model_rating', 'rating');
        $this->load->model('model_users', 'users');
        $this->load->model('model_chat', 'chat');
        $this->load->model('model_wishes', 'wishes');
        $this->load->model('model_upload');
        $this->load->model('model_categories','categories');        
        $this->load->model('model_user_control','userControl');        
    }

    public function addItem()
    {
        $this->form_validation->set_rules('title', 'Title','required|trim');
        $this->form_validation->set_rules('description', 'Description','required|trim');
        $this->form_validation->set_rules('category', 'Category','required');
        // $this->form_validation->set_rules('wishes', 'Wishes','required');
        // var_dump($this->input->post());die;
        if($this->form_validation->run()) {
            // die('here');
            $db_item = array(
                'item_date_add' => date('Y-m-d H:i:s'),
                'item_status' => '0',
                'item_title' => $this->input->post('title'),
                'item_description' => $this->input->post('description'),
                'item_idcategory' => $this->input->post('category'),
                'item_idprofile' => $this->session->userdata('idProfile'),
            );
            
            $this->db->trans_begin();
            
            $this->itens->addItem($db_item);
            $idItem = $this->db->insert_id();
            
            $wishes = $this->input->post('wishes');
            if($wishes){
                foreach($wishes AS $key=>$value){
                    $db_wishes[] = array(
                        'iw_item' => $idItem,
                        'iw_wish'  => $value
                    );
                }
                $this->wishes->addWishes($db_wishes);
            }
                
            if ($_FILES) {
                $this->model_upload->uploadImagesItem($idItem);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while adding a Item!</div>");
                redirect('Item/addItem');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Item added with success!</div>");
                redirect('Home');
            }
        }

        $data['add'] = TRUE;
        $data['wishes'] = $this->wishes->getWishes();        
        $data['categories'] = $this->categories->getCategoriesArray();
        $this->load->view('Item/add', $data);
    }

    public function listItems()
    {
        $idProfile = $this->session->userdata('idProfile');

        $data['currentItems'] = $this->itens->getItems($idProfile,'0');
        if($data['currentItems']){
            foreach($data['currentItems'] AS $item){
                $item->wishes = $this->wishes->getWishesByIdItem($item->item_id);
            }
        }

        $data['tradedItems'] = $this->itens->getItems($idProfile,'1');
        if($data['tradedItems']){
            foreach($data['tradedItems'] AS $item){
                $item->wishes = $this->wishes->getWishesByIdItem($item->item_id);
            }
        }
        // var_dump($data,$idProfile);die;
        $this->load->view('Item/list', $data);
    }

    public function deleteItem($idItem)
    {
        $this->itens->deleteItem($idItem);
        $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>The Item was deleted!</div>");
        redirect('Item/listItems');
    }

    public function editItem($idItem)
    {
        $this->form_validation->set_rules('title', 'Title','required|trim');
        $this->form_validation->set_rules('description', 'Description','required|trim');
        $this->form_validation->set_rules('category', 'Category','required');
        // $this->form_validation->set_rules('wishes', 'Wishes','required');

        if($this->form_validation->run()) {
            $db_item = array(
                'item_title' => $this->input->post('title'),
                'item_description' => $this->input->post('description'),
                'item_idcategory' => $this->input->post('category')
            );
            
            $this->db->trans_begin();

            $this->itens->updateItem($idItem, $db_item);

            $wishes = $this->input->post('wishes');
            if($wishes){
                foreach($wishes AS $key=>$value){
                    $db_wishes[] = array(
                        'iw_item' => $idItem,
                        'iw_wish'  => $value
                    );
                }
                $this->wishes->deleteWishesByIdItem($idItem);
                $this->wishes->addWishes($db_wishes);
            }

            if ($_FILES) {
                $this->model_upload->uploadImagesItem($idItem);
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while editing a Item!</div>");
                redirect('Item/editItem/'.$idItem);
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Item edited with success!</div>");
                redirect('Home/listTrades');
            }
        }

        $data['edit'] = TRUE;
        $data['wishes'] = $this->wishes->getWishes();                
        $wishesItem = $this->wishes->getWishesByIdItem($idItem);
        $idsItem = array();
        if($wishesItem){
            foreach($wishesItem AS $wish) {
                $idsItem[$wish->typ_id] = $wish;
            }        
        }
        $data['wishesItem'] = $idsItem;
        $data['categories'] = $this->categories->getCategoriesArray();    
        $data['item'] = $this->itens->getItemById($idItem);
        $this->load->view('Item/add',$data);
    }

    public function itemDetails($idItem)
    {
        date_default_timezone_set('UTC');
        $data['profileLogged'] = $this->session->userdata('idProfile');
        $data['item'] = $this->itens->getItemById($idItem);
        $data['wishes'] = $this->wishes->getWishesByIdItem($idItem);
        $data['profileItem'] = $data['item']->item_idprofile;
               
        $userControl = array(
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'item_id' => $idItem,
        );

        // Recupera objeto user_control do banco, com base no ip e id do item
        $db_userControl = $this->userControl->getUserControl($userControl);
        
        if (!$db_userControl) {
          // Recupera a troca para verificar a quantidade de visualizações que a mesma possui
          $info_itens = $this->itens->getItemById($idItem); 
          // Incremente a quantidade de visualizações do item
          $count_views = ($info_itens->item_views) + 1; 
          // Salva o click visualizado do item no banco de dados
          $this->itens->updateItem($idItem, array('item_views' => $count_views));
          // Salva o registro de acesso na tabela de 'user_control'
          $this->userControl->addUserControl($userControl);           
        } else {
            // Recupera a data de acesso gravado no BD
            $db_date = $db_userControl->access_date;
            $db_date = new DateTime($db_date);
            // Adiciona 5 minutos na data do BD para controle do acesso
            $db_date->modify('+5 minutes');
            // Recupera a data atual do sistema
            $date = new DateTime();

            // Verifica se a data atual (date) é maior que a data do banco (+5 minutos), com isso o sistema contará a view 
            if ($date > $db_date) {
                // Recupera a troca para verificar a quantidade de visualizações que a mesma possui
                $info_itens = $this->itens->getItemById($idItem);   
                // Incremente a quantidade de visualizações do item
                $count_views = ($info_itens->item_views) + 1; 
                // Salva o click visualizado do item no banco de dados
                $this->itens->updateItem($idItem, array('item_views' => $count_views));
                // Cria um array com a nova data de acesso
                $userControl_update = array(
                    'access_date' => $date->format("Y-m-d H:i:s"),
                );
                // Salva o registro de acesso na tabela de 'user_control'
                $this->userControl->updateUserControl($userControl_update,$db_userControl->id_user_control);
            }
        }
                
        $this->load->view('Item/details', $data);
    }

    public function Report($idItem)
    {

        $motive = ($this->input->post('motive')) ? $this->input->post('motive') : '';

        $this->form_validation->set_rules('motive', 'Motive','required|trim');
        $this->form_validation->set_rules('description', 'description','trim');

        if($this->form_validation->run()){
            $db_report = array(
                'rep_iditem'        => $idItem,
                'rep_motive'        => $this->input->post('motive'),
                'rep_description'   => $this->input->post('description'),
                'rep_status'        => '1'
            );

            $this->reports->addReportItem($db_report);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while reporting an Item!</div>");
                redirect('Item/Report/'.$idItem);
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Report submitted successfully!</div>");
                redirect('Home');
            }
        }

        
        $data['motives'] = array('' => 'Select a motive', '1' => 'Inappropriate Content');
        $data['motive'] = $motive;        
        $data['item'] = $this->itens->getItemById($idItem);
        $data['title'] = 'Report Item';
        $this->load->view('Item/report',$data);
    }

    public function newMessage($idItem)
    {
        $message = $this->input->post('message');
        $idOwner = $this->input->post('idOwner');

        $idProfile = $this->session->userdata('idProfile');
        $idProfileItem = $this->itens->getIdProfileByItem($idItem);
        
        if(!$this->chat->hasChat($idItem)){
            $chat = $this->chat->createChat($idItem,$idOwner);
        }else{
            $chat = $this->chat->getChatId($idItem);
        }


        $this->chat->addMessage($chat,$message,$idProfile);
        
        $username = $this->users->getUsernameByProfile($idProfile);

        $userItemOwner = $this->itens->getItemById($idItem)->user_id;
        if($userItemOwner != $this->session->userdata('idUser')){
            $dbNotification = array(
                'notif_iduser'          => $userItemOwner,
                'notif_date_add'        => date('Y-m-d H:i:s'),
                'notif_status'          => '1',
                'notif_message'         => 'You received a new message!',
                'notif_type'            => 'MESSAGE',
                'notif_chat'            => $chat
            );
    
            $this->notifications->addNotification($dbNotification);
        }

        $arr = array(
            'username' => $username,
            'message' => $message,
            'side' => 'R',
            'time' => date('Y-m-d H:i:s')
        );
        echo json_encode($arr); 
        die;
    }

    public function getMessagesChat($idItem){
        
        
        $idProfile = $this->session->userdata('idProfile');
        
        if($this->chat->hasChat($idItem)){
            $chat = $this->chat->getChatId($idItem);
        } else {
            return json_encode(array());
        }
        $msgsChat = $this->chat->getMessagesChat($chat);

        $arr = array();
        foreach($msgsChat AS $msg){
            $arr[] = array(
                'username' => $msg->username,
                'message' => $msg->message,
                'idmessage' => $msg->id,
                'profilePicture' => (is_null($msg->picture)) ? 'user-default.jpg' : $msg->picture,
                'time' => $msg->time,
                'replied' => is_null($msg->reply) ? FALSE : TRUE,
                'reply' => $msg->reply,
                'idProfile' => $msg->idProfile
            );
        }

        echo json_encode($arr);
        die;
    }

    public function replyMessage()
    {
        $message = $this->input->post('message');
        $idmessage = $this->input->post('idMessage');

        $this->chat->addReply($message,$idmessage);

        $arr = array(
            'reply' => $message,
        );
        echo json_encode($arr); 
        die;
    }

    public function seeChat($chatId, $notifId){
        $this->notifications->updateNotification(array('notif_status' => '0'),$notifId);
        $idItem = $this->chat->getItemByChat($chatId);
        $data['profileLogged'] = $this->session->userdata('idProfile');
        $data['item'] = $this->itens->getItemById($idItem);
        $data['wishes'] = $this->wishes->getWishesByIdItem($idItem);
        $data['profileItem'] = $data['item']->item_idprofile;
        $this->load->view('Item/details', $data);
    }
}
