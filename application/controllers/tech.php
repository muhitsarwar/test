<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class tech extends CI_Controller {

    private $nav = array(array("Profile", "profile"), array("Add Report", "aReport"));

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

    public function checkLogin() {
        $id = (int) $this->session->userdata('user_name');
        $id = (int) ($id / 10000);
        if (!$this->session->userdata('is_logged_in') || $id != 13)
            redirect('main/login');
    }

    public function profile() {
        $this->checkLogin();
        $this->load->view('v2/t_profile');
    }

    public function showProfile() {
        $this->checkLogin();


        $this->load->model('tech_user');



        $result = $this->tech_user->showProfile();
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
            $profile .= 'Test Id: ';
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


        $this->load->model('tech_user');
//
        $this->tech_user->updateProfile($pNo, $pwd, $gender);
    }

    public function aReport() {
        $this->checkLogin();
        $this->load->view('v2/t_aReport');
    }

    public function showTestField() {
        $this->checkLogin();
        $this->load->model('tech_user');



        $result = $this->tech_user->showTestField();
        $profile = '<center><input type="text" id="pid" class="form-control" placeholder="Patient Id"><hr>';
        $counter = 1;
        foreach ($result->result_array() as $row) {
            $profile .= '<input type="text" id="elm_' . $counter . '" class="form-control" placeholder="' . $row['tField'] . '"><hr>';
            $counter++;
        }

        $profile .= '</center>';
        echo $profile;
    }

    public function cReport() {
        $this->checkLogin();
        $pid = $_GET['pid'];

        $fName = 'r' . $this->session->userdata('user_name') . date("Ymdhisa") . '.pdf';
        require_once($_SERVER['DOCUMENT_ROOT'] . '/test/fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Patient Id: ' . $pid, 1, 1, 'C');
        $count = 1;
        while ($_GET['elm_' . $count] != 'undefined: undefined') {
            $pdf->Cell(0, 10, $_GET['elm_' . $count], 1, 1, 'C');
            $count++;
        }

        $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/test/reports/' . $fName, 'F');


//        echo $pid . '<br>' . $elm_1 . '<hr>' . $elm_2 . '<hr>' . $elm_3 . '<hr>' . $elm_4 . '<hr>' . $elm_5 . '<hr>' . $elm_6 . '<hr>' . $elm_7;
        $this->load->model('tech_user');

        $this->tech_user->cReport($pid, $fName);
    }

    public function update() {
        $this->checkLogin();
        $this->load->view('t_update');
    }

    public function index() {
        redirect('tech/home');
    }

    public function home() {
        $this->checkLogin();
        $this->load->view('t_home');
    }

    public function addreport() {
        $this->checkLogin();
        $pid = (int) $_GET['pid'];
        $tid = (int) $_GET['tid'];
        $report = $_GET['report'];
        $this->load->model('tech_user');

        $this->tech_user->addreport($pid, $tid, $report);
    }

    public function report() {
        $this->checkLogin();


        $template = array(
            'table_open' => '<table   border="1" cellpadding="4" cellspacing="0">',
            'thead_open' => '<thead>',
            'thead_close' => '</thead>',
            'heading_row_start' => '<tr>',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'tbody_open' => '<tbody>',
            'tbody_close' => '</tbody>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td>',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td >',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );

        $this->table->set_template($template);
        $this->load->model('tech_user');
        $result = $this->tech_user->show_report();
        echo $this->table->generate($result);
    }

    public function reports() {
        $this->checkLogin();
        $this->load->view('t_reports');
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