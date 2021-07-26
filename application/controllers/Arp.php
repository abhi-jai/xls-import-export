<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Arp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CatModel');
    }
    function index()
    {
        $data['title'] = 'Category Form';
        $data['category'] = $this->CatModel->getCat();
        $this->load->view('include/header', $data);
        $this->load->view('form');
    }


    function save()
    {
        $this->fv->set_rules('category', 'Category Name', 'required|trim');
        $this->fv->set_rules('parent_category', 'Parent Category Name', 'trim');
        if ($this->fv->run() == false) {
            $this->index();
        } else {
            $input = $this->input->post();
            $insArr = array(
                'name' => $input['category'],
                'parent_category' => (!empty($input['parent_category']) && $input['parent_category'] != "") ? $input['parent_category'] : 0
            );
            $this->CatModel->saveCat($insArr);
        }
        redirect('Arp');
    }
}
