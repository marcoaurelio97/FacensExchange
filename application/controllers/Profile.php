<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
    }
    public function index()
	{
		redirect('Home/listTrades');
    }
    public function register(){
        // var_dump($this->input->post());die;
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
            $this->load->model('Model_profiles', 'profiles');
            $this->load->model('Model_address', 'adress');
            $this->load->model('Model_telephone', 'telephone');
            
            $this->db->trans_begin();

            $db_profiles = array(
                'pro_name' => $this->input->post('name'),
                'pro_date_of_birth' => $this->input->post('birth'),
                'pro_rg' => $this->input->post('rg'),
                'pro_cpf' => $this->input->post('cpf')
            );

            $this->profiles->add($db_profiles);

            $idProfile = $this->db->insert_id();

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
            
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('item', "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>An error occurred while adding your profile!</div>");
                redirect('Profile/register');
            } else {
                $this->db->trans_commit();
                $this->session->set_flashdata('item', "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i> Alert!</h4>Profile added with success!</div>");
                redirect('Home');
            }

        }
        $this->load->view('profile');
    }
}