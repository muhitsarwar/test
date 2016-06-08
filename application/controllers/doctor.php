<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class doctor extends CI_Controller {

    private $nav = array(array("Profile", "profile"), array("Patient History", "phistory"), array("Prescribe", "prescribe"), array("Approve", "approve"), array("Create Operation", "operation"));

    public function checkLogin() {
        $id = (int) $this->session->userdata('user_name');
        $id = (int) ($id / 10000);
        if (!$this->session->userdata('is_logged_in') || $id != 11)
            redirect('main/login');
    }

    public function uTest() {
        $this->load->library('unit_test');

        $this->unit->run($this->report(1000001), 'BLOODBLOOD', 'testing report function');

        $this->unit->run($this->patientInfo(1000001), 'SAFI SABUJ1', 'testing patientInfo function');

        $this->unit->run($this->checkLogin(), false, 'testing checkLogin function');

        $this->load->view('tests');
    }

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
        session_start();
        $_SESSION['current_patient'] = '';

        $this->load->view('v2/d_profile');
    }

    public function showProfile() {
        $this->checkLogin();


        $this->load->model('doctor_user');



        $result = $this->doctor_user->showProfile();
        $profile = '<center>';
        foreach ($result->result_array() as $row) {

            $profile .= 'Name: ';
            $profile .= $row['name'];
            $profile .= "<hr>";
            $profile .= 'Gender: ';
            $profile .= $row['gender'];
            $profile .= "<hr>";
            $profile .= 'Phone NO: +880';
            $profile .= $row['pNO'];
            $profile .= "<hr>";
            $profile .= 'Join Date: ';
            $profile .= $row['jDate'];
            $profile .= "<hr>";
        }
        $profile .= '</center>';
        echo $profile;
    }

    public function phistory() {
        $this->checkLogin();
        session_start();
        $this->load->view('v2/d_patient_history');
    }

    public function report() {
        $this->checkLogin();
        $pid = $_GET['pid'];

        $_SESSION["current_patient"] = $pid;
        $this->load->model('doctor_user');
        $result = $this->doctor_user->show_report($pid);




        $profile = '';
        foreach ($result->result_array() as $row) {
            $profile .= '<div class = "col-sm-4 well">';
            $profile .= 'Test Name: ';
            $profile .= $row['tName'];
            $profile .= "<hr>";
            if ($row['tReport'] != '') {
                $profile .= 'Report: ';
                $profile .='<a href = "' . base_url() . 'reports/' . $row['tReport'] . '">click to view</a>';
                $profile .= "<hr>";
            }
            $profile .= 'Date: ';
            $profile .= $row['vDate'];
            $profile .= "<hr>";
            $profile .= 'by(Doctor): ';
            $profile .= $row['dName'];
            $profile .= "<hr>";
            $profile .= "</div>";
        }

        echo $profile;
    }

    public function patientInfo() {
        $this->checkLogin();
        $pid = $_GET['pid'];
        session_start();
        $_SESSION["current_patient"] = $pid;
        $this->load->model('doctor_user');
        $result = $this->doctor_user->patientInfo($pid);



        $profile = '';
        $profile = '<center>';
        foreach ($result->result_array() as $row) {
            $profile .= '<div class = "well">';
            $profile .= 'Patient Name: ';
            $profile .= $row['name'];
            $profile .= "<hr>";
            $profile .= 'Admission Date: ';
            $profile .= $row['aDate'];
            $profile .= "<hr>";
            $profile .= 'Phone No: +880';
            $profile .= $row['phn'];
            $profile .= "<hr>";
            $profile .= 'Gender: ';
            $profile .= $row['gender'];
            $profile .= "<hr>";
            $profile .= 'Hight: ';
            $profile .= $row['hight'].' meteres';
            $profile .= "<hr>";
            $profile .= 'Weight: ';
            $profile .= $row['weight'].' kg';
            $profile .= "<hr>";
            $profile .= 'Word No: ';
            $profile .= $row['word'];
            $profile .= "<hr>";
            $profile .= "</div>";
        }
        $profile .= "</center>";
        echo $profile;
    }

    public function patientMed() {
        $this->checkLogin();
        $pid = $_GET['pid'];
        $_SESSION["current_patient"] = $pid;
        $template = array(
            'table_open' => '<table class="table table-hover">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '<td></td></tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '<td></td></tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('doctor_user');
        $result = $this->doctor_user->prescription_table($pid);

        echo $this->table->generate($result);
    }

    public function getUMed() {
        $this->checkLogin();

        $template = array(
            'table_open' => '<table class="table table-hover">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '<td><input class = "cbox" value = "muht" type="checkbox" /></td></tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '<td><input class = "cbox" value = "sadia" type="checkbox" /></td></tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('doctor_user');
        $result = $this->doctor_user->uMed();

        echo $this->table->generate($result);
    }

    public function getNurse() {
        $this->checkLogin();

        $template = array(
            'table_open' => '<table class="table table-hover">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '<td><input class = "cbox" value = "muht" type="checkbox" /></td></tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '<td><input class = "cbox" value = "sadia" type="checkbox" /></td></tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('doctor_user');
        $result = $this->doctor_user->getNurse();

        echo $this->table->generate($result);
    }

    public function getUEq() {
        $this->checkLogin();

        $template = array(
            'table_open' => '<table class="table table-hover">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '<td><input class = "cbox" value = "muht" type="checkbox" /></td></tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '<td><input class = "cbox" value = "sadia" type="checkbox" /></td></tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('doctor_user');
        $result = $this->doctor_user->uEq();

        echo $this->table->generate($result);
    }

    public function prescribe() {
        $this->checkLogin();
        session_start();
        $this->load->view('v2/d_prescribe');
    }

    public function index() {
        redirect('doctor/profile');
    }

    public function operation() {
        $this->checkLogin();
        session_start();
        $this->load->view('v2/d_create_operation');
    }

    public function approve() {
        $this->checkLogin();
        session_start();
        $this->load->view('v2/d_approve');
    }

    public function addtest() {
        $this->checkLogin();
        $pid = $_GET['pid'];
        $tid = $_GET['tid'];
        session_start();
        $_SESSION["current_patient"] = $pid;
        $this->load->model('doctor_user');

        $this->doctor_user->addtest($pid, $tid);
    }

    public function aNurse() {
        $this->checkLogin();
        $po_id = $_GET['po_id'];
        $n_id = $_GET['n_id'];




        $this->load->model('doctor_user');

        $this->doctor_user->aNurse($po_id, $n_id);
//        echo $po_id." ".$n_id;
    }

    public function aMed() {
        $this->checkLogin();
        $po_id = $_GET['po_id'];
        $n_id = $_GET['n_id'];




        $this->load->model('doctor_user');

        $this->doctor_user->aMed($po_id, $n_id);
//        echo $po_id." ".$n_id;
    }

    public function aEq() {
        $this->checkLogin();
        $po_id = $_GET['po_id'];
        $n_id = $_GET['n_id'];



//
        $this->load->model('doctor_user');

        $this->doctor_user->aEq($po_id, $n_id);
//        echo $po_id." ".$n_id;
    }

    public function updateProfile() {
        $this->checkLogin();
        $pNo = $_GET['pNo'];
        $pwd = $_GET['pwd'];
        $gender = $_GET['gender'];
        $pwdo = $_GET['pwdo'];
        $speciality = $_GET['speciality'];
        
        
        $this->load->model('doctor_user');
        if(!$this->doctor_user->vPassword($pwdo)){
            echo 'error';
            return;
        }
        
        
        $this->doctor_user->updateProfile($pNo, $pwd, $gender, $speciality);
    }

    public function addmedicine() {
        $this->checkLogin();
        $mid = $_GET['mid'];
        $date = $_GET['date'];
        $time = $_GET['time'];
        $quan = $_GET['quan'];
        $pid = $_GET['pid'];
        $repeat = $_GET['repeat'];
        
        
        session_start();
        $_SESSION["current_patient"] = $pid;
//
        $this->load->model('doctor_user');
        
        for ($i = 0; $i < (int) $repeat; $i++) {
            $tdate = $date;
            $date = strtotime($date . ' ' . $time);
            $date = date('Y-m-d H:i', $date);
//
            $this->doctor_user->addmedicine($mid, $date, $quan, $pid);
            $tdate++;
            $date = $tdate;
        }
        echo 'ok';
    }

    public function createOperation() {
        $this->checkLogin();
        $oid = $_GET['oid'];
        $date = $_GET['date'];
        $time = $_GET['time'];
        $pid = $_GET['pid'];
        session_start();
        $_SESSION["current_patient"] = $pid;
        $date = strtotime($date . ' ' . $time);
        $date = date('Y-m-d H:i', $date);
        $did = (int) $this->session->userdata('user_name');

        //$time = date("H:i:", strtotime($time));
        $time = $date;
        $this->load->model('doctor_user');

        $this->doctor_user->adddoctor($pid, $oid, $did, $time);
        echo $oid . $date . $time . $pid;
    }

    public function addDoctor() {
        $this->checkLogin();
        $oid = $_GET['oid'];
        $date = $_GET['date'];
        $time = $_GET['time'];
        $dida = $_GET['did'];
        $pid = $_GET['pid'];
        session_start();
        $_SESSION["current_patient"] = $pid;
        $date = strtotime($date . ' ' . $time);
        $date = date('Y-m-d H:i', $date);
        $dids = explode(" ", $dida);

        //$time = date("H:i:", strtotime($time));
        $time = $date;
        $this->load->model('doctor_user');
        foreach ($dids as $did) {
            $this->doctor_user->adddoctor($pid, $oid, $did, $time);
        }

        echo $oid . $date . $time . $pid;
    }

    public function search() {
        $this->checkLogin();
        $term = $_GET['term'];
        $table = $_GET['table'];
        $this->load->model('doctor_user');

        $return_arr = $this->doctor_user->search($term, $table);
        echo json_encode($return_arr);
        //echo $term."to return in ajax function success";
    }

}

?>