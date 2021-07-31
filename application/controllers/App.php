<?php
defined('BASEPATH') or exit('No direct script access allowed');
class App extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AppModel');
    }
    function index()
    {
        $data['title'] = 'Category Form';
        $this->load->view('include/header', $data);
        $this->load->view('form');
    }
    function save()
    {
        require_once APPPATH . "/third_party/SimpleXlsx.php";
        if ($_FILES['xlsx']['name'] != "") {
            $file = $_FILES['xlsx']['tmp_name'];
            if ($x = SimpleXLSX::parse($file)) {
                $userDetail = $x->rows();
                $stateDetail = $x->rows(1);
                $cityDetail = $x->rows(2);
                if (!empty($userDetail)) {
                    foreach ($userDetail as $usr) {
                        $user[] = array(
                            'name' => $usr[1],
                            'email' => $usr[2],
                            'phone' => $usr[3],
                            'state_id' => $usr[4],
                            'city_id' => $usr[5]
                        );
                    }
                    unset($user[0]);
                    // $this->pre($user);
                    $lastID = $this->AppModel->saveData($user);
                }
                if (!empty($stateDetail)) {
                    foreach ($stateDetail as $state) {
                        $states[] = array(
                            'id' => $state[0],
                            'state_name' => $state[1]
                        );
                    }
                    unset($states[0]);
                    $this->AppModel->saveData($states, 'state');
                }
                if (!empty($cityDetail)) {
                    foreach ($cityDetail as $city) {
                        $cities[] = array(
                            'id' => $city[0],
                            'city_name' => $city[1]
                        );
                    }
                    unset($cities[0]);
                    $this->AppModel->saveData($cities, 'city');
                }
            }
        }
        $users = [];
        if ($lastID) {
            $users = $this->AppModel->getusersData($lastID);
        }
        $data['state'] = $this->AppModel->getData("state");
        $data['city'] = $this->AppModel->getData("city");
        $data['users'] = $users;
        $this->load->view('include/header', $data);
        $this->load->view('form');
    }
    
    function download()
    {
        $file = base_url('upload/users-detail.xlsx');
        ob_end_clean();
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        readfile($file);
    }
}
