<?php
class CatModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function saveCat($data)
    {
        $this->db->insert('category', $data);
    }
    function getCat()
    {
        return  $this->db->get('category')->result();
    }
}
