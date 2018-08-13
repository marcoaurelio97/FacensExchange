<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_upload extends CI_Model {
    public function uploadImagesItem($idItem)
    {
        $this->load->model('Model_itens', 'itens');

        $nameImage = $_FILES['image']['name'];

        $config = array(
            'upload_path' => './dist/img/',
            'allowed_types' => '*',
            'file_name' => $nameImage,
            'max_size' => '1000000'
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $db = array(
                'itempic_iditem' => $idItem,
                'itempic_picture' => $nameImage
            );

            $this->itens->insertPicItem($db);

            return true;
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function uploadImagesProfile($idProfile)
    {
        $this->load->model('Model_profiles', 'profiles');
        // var_dump('teste');die;
        $nameImage = $_FILES['image']['name'];

        $config = array(
            'upload_path' => './dist/img/',
            'allowed_types' => '*',
            'file_name' => $nameImage,
            'max_size' => '1000000'
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $db = array(
                'pro_picture' => $nameImage
            );

            $this->profiles->insertPicProfile($db,$idProfile);

            return true;
        } else {
            echo $this->upload->display_errors();
        }
    }
}