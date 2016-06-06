<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Main extends CI_Controller {
 
 
    public function index() {
        redirect('main/home');
    }

    public function login() {

        if ($this->session->userdata('is_logged_in')) {
            redirect('main/home');
        } else {
            $this->load->view('login');
        }
    }


    public function home() {
        if ($this->session->userdata('is_logged_in')) {
            $id = (int) $this->session->userdata('user_name');
            $id = (int) ($id / 10000);

            switch ($id) {
                case 11: redirect('doctor/profile');
                    break;
                case 12:redirect('nurse/profile');
                    break;
                case 13:redirect('tech/profile');
                    break;
                case 14:redirect('recp/profile');
                    break;
                default:redirect('patient/info');
                    break;
            }
        } else {
            redirect('main/login');
        }
    }

    public function muhit() {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('muhit');
        } else {
            redirect('main/login');
        }
    }

    public function login_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("user_name", "User Name", "required|callback_validate_credentials");
        $this->form_validation->set_rules("password", "Password", "required");

        if ($this->form_validation->run()) {
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'is_logged_in' => 1
            );

            $this->session->set_userdata($data);
            redirect('main/home');
        } else {
            $this->login();
        }
    }

    public function validate_credentials() {
        $this->load->model('main_user');

        if ($this->main_user->can_log_in()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'incorrect username or password');
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('main/login');
    }

}

?>