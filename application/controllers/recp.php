<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class recp extends CI_Controller {
    private $nav = array(array("Profile", "profile"), array("Add Patient", "apet"), array("Release Patient", "rpet"));

    public function getNav() {
        $this->checkLogin();
        $tab = $_GET['aTab'];
        $nPanel = '';
        $nPanel .= '<ul class = "nav nav-pills nav-justified">';

        foreach ($this->nav as $v) {
            $nPanel .= '<li class = "';
            if ($tab == $v[0]) {
                $nPanel .= "active";
            }
            $nPanel .= '"><a href = "';
            $nPanel .= $v[1];
            $nPanel .= '" >';
            $nPanel .= $v[0];
            $nPanel .= '</a></li><hr>';
        }



        $nPanel .= '</ul>';

        echo $nPanel;
    }
    
    
    public function profile() {
        $this->checkLogin();
        $this->load->view('v2/r_profile');
       
    }
    
    public function apet() {
        $this->checkLogin();
        $this->load->view('v2/r_add');
       
    }
    
    public function showProfile() {
        $this->checkLogin();


        $this->load->model('recp_user');



        $result = $this->recp_user->showProfile();
        $profile = '<center>';
        foreach ($result->result_array() as $row) {

            $profile .= 'Name: ';
            $profile .= $row['name'];
            $profile .= "<hr>";
            $profile .= 'Gender: ';
            $profile .= $row['gender'];
            $profile .= "<hr>";
            $profile .= 'Phone NO: ';
            $profile .= $row['pNO'];
            $profile .= "<hr>";
            $profile .= 'Join Date: ';
            $profile .= $row['jDate'];
            $profile .= "<hr>";
        }
        $profile .= '</center>';
        echo $profile;
    }
    
    public function updateProfile() {
        $this->checkLogin();
        $pNo = $_GET['pNo'];
        $pwd = $_GET['pwd'];
        $gender = $_GET['gender'];


        $this->load->model('recp_user');
//
        $this->recp_user->updateProfile($pNo, $pwd, $gender);
    }
    
    public function checkLogin() {
        $id = (int) $this->session->userdata('user_name');
        $id = (int)($id/10000);
        if (!$this->session->userdata('is_logged_in') || $id != 14) 
            redirect('main/login');
    }
    

    
    public function rpet() {
        $this->checkLogin();
        $this->load->view('v2/r_bill');
       
    }
    
    public function index() {
        redirect('recp/profile');
    }

     public function addpatient() {
        $this->checkLogin();
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $pNo = $_GET['pNo'];
        $gender = $_GET['gender'];
        $wNo =$_GET['wNo'];
        
        $hight = $_GET['hight'];
        $weight = $_GET['weight'];
       
        $this->load->model('recp_user');

       $result =  $this->recp_user->addpatient($fname,$lname,$pNo,$gender,$wNo,$hight,$weight);
        
        
        $rtn = "<p>";
        foreach ($result->result_array() as $row) {
            $rtn .= $row['id'];
        }
        $rtn .= "</p>";
        echo $rtn;
    }
    


    
    

}

?>