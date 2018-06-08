<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class finalizarProfile
{
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function checkAccess()
    {
        $this->ci->load->model('model_users', 'users');

        $directory  = $this->ci->router->directory;
        $action     = $this->ci->router->method;
        $controller = $this->ci->router->class;

        if ($this->ci->session->userdata('idUser')) {
            if ($action !== 'signOut') {
                if ($action !== 'register' && !$this->ci->users->hasProfile($this->ci->session->userdata('idUser'))) {
                    redirect('Profile/register');
                }
            }
        }
    }
}