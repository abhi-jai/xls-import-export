<?php
class AppModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function saveData($data, $table="users")
    {
        $this->db->insert_batch($table, $data);
        return $this->db->insert_id();
    }
    function getusersData($lastid)
    {
        return $this->db->where('id >=', $lastid)->get('users')->result();
    }
    function getData($table)
    {
        return $this->db->get($table)->result();
    }

}
