<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class nurse extends CI_Controller {

    private $nav = array(array("Profile", "profile"), array("Patient Medicine", "pmed"), array("Operation", "operation"), array("Add Med&Equipment", "medandeq"));

    public function showProfile() {
        $this->checkLogin();


        $this->load->model('nurse_user');



        $result = $this->nurse_user->showProfile();
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
            $profile .= 'Word No: ';
            $profile .= $row['wNo'];
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


        $this->load->model('nurse_user');
//
        $this->nurse_user->updateProfile($pNo, $pwd, $gender);
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

    public function checkLogin() {
        $id = (int) $this->session->userdata('user_name');
        $id = (int) ($id / 10000);
        if (!$this->session->userdata('is_logged_in') || $id != 12)
            redirect('main/login');
    }

    public function profile() {
        $this->checkLogin();

        $this->load->view('v2/n_profile');
    }

    public function pmed() {
        $this->checkLogin();

        $this->load->view('v2/n_patient_med');
    }

    public function operation() {
        $this->checkLogin();

        $this->load->view('v2/n_operation');
    }

    public function medandeq() {
        $this->checkLogin();

        $this->load->view('v2/n_med&eq');
    }



    public function index() {
        redirect('nurse/profile');
    }

    public function showMedicine() {
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
        $this->load->model('nurse_user');
        $result = $this->nurse_user->prescription_table();

        echo $this->table->generate($result);
    }

    public function getUOperation() {
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
        $this->load->model('nurse_user');
        $result = $this->nurse_user->getUOperation();

        echo $this->table->generate($result);
    }

    public function getAOperation() {
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
            'row_end' => '<td></tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '<td></tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('nurse_user');
        $result = $this->nurse_user->getAOperation();

        echo $this->table->generate($result);
    }

    public function getROperation() {
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
            'row_end' => '<td></tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '<td></tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('nurse_user');
        $result = $this->nurse_user->getROperation();

        echo $this->table->generate($result);
    }

    public function done() {
        $this->checkLogin();
        $vid = (int) $_GET['vid'];
        $mid = (int) $_GET['mid'];
        $time = $_GET['time'];

        $this->load->model('nurse_user');
        $this->nurse_user->update_nurse_check($vid, $mid, $time);
    }
    public function amed() {
        $this->checkLogin();

        $mid = (int) $_GET['mid'];


        $this->load->model('nurse_user');
        $this->nurse_user->amed($mid);
        echo $mid;
    }
    public function aeq() {
        $this->checkLogin();

        $mid = (int) $_GET['eid'];


        $this->load->model('nurse_user');
        $this->nurse_user->aeq($mid);
        echo $mid;
    }
    public function rOperation() {
        $this->checkLogin();
        $po_id = (int) $_GET['po_id'];


        $this->load->model('nurse_user');
        $this->nurse_user->rOperation($po_id);
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