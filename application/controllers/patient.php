<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class patient extends CI_Controller {

    private $nav = array(array("Info", "info"), array("Medicine", "med"), array("Test", "test"), array("Operation", "operation"));

    public function getNav() {

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

    public function showInfo() {
        $this->load->model('patient_user');



        $result = $this->patient_user->showInfo();
        $profile = '<center>';
        foreach ($result->result_array() as $row) {

            $profile .= 'Id: ';
            $profile .= $row['pid'];
            $profile .= "<hr>";
            $profile .= 'Name: ';
            $profile .= $row['name'];
            $profile .= "<hr>";
            $profile .= 'Gender: ';
            $profile .= $row['gender'];
            $profile .= "<hr>";
            $profile .= 'Admission Date: ';
            $profile .= $row['adate'];
            $profile .= "<hr>";
            $profile .= 'Word No: ';
            $profile .= $row['wno'];
            $profile .= "<hr>";
        }
        $profile .= '</center>';
        echo $profile;
    }

    public function umed() {

        $this->load->view('v2/p_med');
    }



    public function index() {
        redirect('patient/home');
    }

    public function med() {

        $this->load->view('v2/p_med');
    }

    public function medicine() {

        $this->load->view('p_medicine');
    }

    public function test() {

        $this->load->view('v2/p_test');
    }

    public function info() {

        $this->load->view('v2/p_info');
    }

    public function operation() {

        $this->load->view('v2/p_operation');
    }

    public function data() {
        $info_for = $_GET['info_for'];
        $pid = (int) $this->session->userdata('user_name');
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
        $this->load->model('patient_user');
        $result = null;
        if ($info_for == 'umed')
            $result = $this->patient_user->umed($pid);
        else if ($info_for == 'tbumed')
            $result = $this->patient_user->tbumed($pid);
        else if ($info_for == 'test_data')
            $result = $this->patient_user->test_data($pid);
        else if ($info_for == 'operation_data')
            $result = $this->patient_user->operation_data($pid);
        else if ($info_for == 'total_cost')
            $result = $this->patient_user->total_cost($pid);
        echo $this->table->generate($result);
    }

    public function reportr() {

      
        $this->load->model('patient_user');
        $result = $this->patient_user->show_reportr();




        $profile = '';
        foreach ($result->result_array() as $row) {
            $profile .= '<div class = "col-sm-4 well">';
            $profile .= 'Test Name: ';
            $profile .= $row['tName'];
            $profile .= "<hr>";
            $profile .= 'Report: ';
            $profile .= '<a href = "'.base_url().'reports/'. $row['tReport'].'">click to view</a>';
            $profile .= "<hr>";
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
    
    public function getPOperation() {

      
        $this->load->model('patient_user');
        $result = $this->patient_user->getPOperation();




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


        echo $this->table->generate($result);
    }
    public function getUOperation() {

      
        $this->load->model('patient_user');
        $result = $this->patient_user->getUOperation();




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


        echo $this->table->generate($result);
    }

    public function reportw() {


        $this->load->model('patient_user');
        $result = $this->patient_user->show_reportw();

//        echo 'ok';


        $profile = '';
        foreach ($result->result_array() as $row) {
            $profile .= '<div class = "col-sm-4 well">';
            $profile .= 'Test Name: ';
            $profile .= $row['tName'];
            $profile .= "<hr>";
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

}

?>