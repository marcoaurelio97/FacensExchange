<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Model_profiles', 'profiles');
        $this->load->model('Model_address', 'adress');
        $this->load->model('Model_telephone', 'telephone');
        $this->load->model('Model_users', 'users');
        $this->load->model('model_upload');        
    }
    public function index()
	{
		redirect('Home/listTrades');
    }
    public function register(){
        $this->form_validation->set_rules('name','Name','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('birth','Date of Birth','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('rg','RG','required|trim','You must provide a %s.'); 
        $this->form_validation->set_rules('cpf','CPF','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('street','Street','required|trim','You must provide a %s.');                
        $this->form_validation->set_rules('number','Number','required|trim','You must provide a %s.');        
        $this->form_validation->set_rules('complement','Complement','trim','You must provide a %s.');
        $this->form_validation->set_rules('zipCode','ZIP Code','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('city','City','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('neighborhood','Neighborhood','required|trim','You must provide a %s.');        
        $this->form_validation->set_rules('uf','UF','required|trim','You must provide a %s.');        
        $this->form_validation->set_rules('telephone','Telephone','required|trim','You must provide a %s.');        
        
        if($this->form_validation->run()) {
            $this->db->trans_begin();

            $db_profiles = array(
                'pro_name' => $this->input->post('name'),
                'pro_date_of_birth' => $this->input->post('birth'),
                'pro_rg' => $this->input->post('rg'),
                'pro_cpf' => $this->input->post('cpf'),
                'pro_rating' => '0',
                'pro_number_of_evaluations' => '0',
                'pro_sum_rating' => '0'
            );

            $this->profiles->add($db_profiles);

            $idProfile = $this->db->insert_id();

            if ($_FILES) {
                $this->model_upload->uploadImagesProfile($idProfile);
            }

            $db_adress = array(
                'address_pro_id' => $idProfile,
                'address_street' => $this->input->post('street'),
                'address_number' => $this->input->post('number'),
                'address_complement' => $this->input->post('complement'),
                'address_zip_code' => $this->input->post('zipCode'),
                'address_neighborhood' => $this->input->post('neighborhood'),               
                'address_city' => $this->input->post('city'),
                'address_uf_state' => $this->input->post('uf')
            );

            $this->adress->add($db_adress);            

            $db_telephone = array(
                'tel_pro_id' => $idProfile,                
                'tel_telephone' => $this->input->post('telephone'),
            );

            $this->telephone->add($db_telephone);  

            $idUser = $this->session->userdata('idUser');
            $this->users->setUserProfile($idUser,$idProfile);
            
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while adding your profile!</div>");
                redirect('Profile/register');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Profile added with success!</div>");
                redirect('Home/listTrades');
            }
        }

        $data['title'] = 'User Profile';
        $this->load->view('profile', $data);
    }

    public function EditProfile($idUser) {

        $this->form_validation->set_rules('name','Name','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('birth','Date of Birth','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('rg','RG','required|trim','You must provide a %s.'); 
        $this->form_validation->set_rules('cpf','CPF','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('street','Street','required|trim','You must provide a %s.');                
        $this->form_validation->set_rules('number','Number','required|trim','You must provide a %s.');        
        $this->form_validation->set_rules('complement','Complement','trim','You must provide a %s.');
        $this->form_validation->set_rules('zipCode','ZIP Code','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('city','City','required|trim','You must provide a %s.');
        $this->form_validation->set_rules('neighborhood','Neighborhood','required|trim','You must provide a %s.');        
        $this->form_validation->set_rules('uf','UF','required|trim','You must provide a %s.');        
        $this->form_validation->set_rules('telephone','Telephone','required|trim','You must provide a %s.');        

        if($this->form_validation->run()) {
            // var_dump($_FILES);die;

            $this->load->model('Model_profiles', 'profiles');
            $this->load->model('Model_address', 'adress');
            $this->load->model('Model_telephone', 'telephone');
            
            $this->db->trans_begin();

            $date = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('birth'))));

            $db_profiles = array(
                'pro_name'          => $this->input->post('name'),
                'pro_date_of_birth' => $date,
                'pro_rg'            => $this->input->post('rg'),
                'pro_cpf'           => $this->input->post('cpf')
            );

            $idProfile = $this->profiles->update($idUser, $db_profiles);

            if ($_FILES) {
                // var_dump('boa');die;    
                
                $this->model_upload->uploadImagesProfile($idProfile);
            }
            // var_dump('vou chorar');die;    
            
            $db_adress = array(
                'address_street' => $this->input->post('street'),
                'address_number' => $this->input->post('number'),
                'address_complement' => $this->input->post('complement'),
                'address_zip_code' => $this->input->post('zipCode'),
                'address_neighborhood' => $this->input->post('neighborhood'),               
                'address_city' => $this->input->post('city'),
                'address_uf_state' => $this->input->post('uf')
            );

            $this->adress->update($idProfile, $db_adress);            

            $db_telephone = array(
                'tel_telephone' => $this->input->post('telephone')
            );

            $this->telephone->update($idProfile, $db_telephone);
            
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while editing your profile!</div>");
                redirect('Profile/register');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Profile edited with success!</div>");
                redirect('Home/listTrades');
            }
        }

        $this->load->model('Model_profiles','profiles');

        $data['profile'] = $this->profiles->getProfileByUserId($idUser);
        $data['profile']->pro_date_of_birth = date('d/m/Y', strtotime($data['profile']->pro_date_of_birth));
        $data['title']   = 'Edit User Profile';
        $this->load->view('profile',$data);
    }

    public function ViewProfile($idUser) {
        $data['profile'] = $this->profiles->getProfileByUserId($idUser);
        $data['roundRating'] = number_format($data['profile']->pro_rating,0);
        
        // $roundRating = number_format($data['profile']->pro_rating,0);

        // if($roundRating == '1') {
        //     $data['roundRating']['1'] = 'glyphicon-star';
        //     $data['roundRating']['2'] = 'glyphicon-star-empty';
        //     $data['roundRating']['3'] = 'glyphicon-star-empty'; 
        //     $data['roundRating']['4'] = 'glyphicon-star-empty'; 
        //     $data['roundRating']['5'] = 'glyphicon-star-empty'; 
            
        // }
        // else if($roundRating == '2') {
        //     $data['roundRating']['1'] = 'glyphicon-star';
        //     $data['roundRating']['2'] = 'glyphicon-star';
        //     $data['roundRating']['3'] = 'glyphicon-star-empty'; 
        //     $data['roundRating']['4'] = 'glyphicon-star-empty'; 
        //     $data['roundRating']['5'] = 'glyphicon-star-empty'; 
        // }
        // else if($roundRating == '3') {
        //     $data['roundRating']['1'] = 'glyphicon-star';
        //     $data['roundRating']['2'] = 'glyphicon-star';
        //     $data['roundRating']['3'] = 'glyphicon-star'; 
        //     $data['roundRating']['4'] = 'glyphicon-star-empty'; 
        //     $data['roundRating']['5'] = 'glyphicon-star-empty'; 
        // }
        // else if($roundRating == '4') {
        //     $data['roundRating']['1'] = 'glyphicon-star';
        //     $data['roundRating']['2'] = 'glyphicon-star';
        //     $data['roundRating']['3'] = 'glyphicon-star'; 
        //     $data['roundRating']['4'] = 'glyphicon-star'; 
        //     $data['roundRating']['5'] = 'glyphicon-star-empty'; 
        // }
        // else if($roundRating == '5') {
        //     $data['roundRating']['1'] = 'glyphicon-star';
        //     $data['roundRating']['2'] = 'glyphicon-star';
        //     $data['roundRating']['3'] = 'glyphicon-star'; 
        //     $data['roundRating']['4'] = 'glyphicon-star'; 
        //     $data['roundRating']['5'] = 'glyphicon-star'; 
        // }
        // var_dump($data);die;
        $data['title'] = 'View Profile';
        $this->load->view('view_profile',$data);
    }

    public function Comments($idProfile){
        $data['comments'] = $this->profiles->getCommentsProfile($idProfile);
        // var_dump($data['comments']);die;
        $this->load->view('comments',$data);
        
    }
}