<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class main_user extends CI_Model{
    public function can_log_in(){
        $user_id = (int)$this->input->post('user_name');
        $user_id = (int)($user_id/ 10000);
        $this->db->where('ID',(int)$this->input->post('user_name'));
        
        
        if($user_id == 11){
            $this->db->where('password',md5($this->input->post('password')));
            $query = $this->db->get('doctor');
        }elseif ($user_id == 12) {
            $this->db->where('password',md5($this->input->post('password')));
            $query = $this->db->get('nurse');
        }elseif($user_id == 13){
            $this->db->where('password',md5($this->input->post('password')));
            $query = $this->db->get('tech');
        }elseif($user_id == 14){
            $this->db->where('password',md5($this->input->post('password')));
            $query = $this->db->get('recp');
        }elseif ($user_id >= 100 ) {
             $query = $this->db->get('patient');
             
        }else{
            $query = null;
        }
        
        
        
        if($query != NULL && $query->num_rows() == 1){
            return true;
        }else {
            return false;
        }
    }
    
    public function changep($opassword,$npassword){   
        $user_id = (int)$this->session->userdata('user_name');
        $user_id = (int)($user_id/ 10000);
        
        
        if($user_id == 11){
            $query = $this->db->query(sprintf("update doctor set password = '%s' where id = %d and password = '%s'",  md5($npassword), (int)$this->session->userdata('user_name') , md5($opassword)));
        }elseif ($user_id == 12) {
            $query = $this->db->query(sprintf("update nurse set password = '%s' where id = %d and password = '%s'",  md5($npassword), (int)$this->session->userdata('user_name') , md5($opassword)));
        }elseif($user_id == 13){
            $query = $this->db->query(sprintf("update tech set password = '%s' where id = %d and password = '%s'",  md5($npassword), (int)$this->session->userdata('user_name') , md5($opassword)));
        }elseif($user_id == 14){
            $query = $this->db->query(sprintf("update recp set password = '%s' where id = %d and password = '%s'",  md5($npassword), (int)$this->session->userdata('user_name') , md5($opassword)));
        }else{
            $query = $this->db->query(sprintf("update error set password = '%s' where id = %d and password = '%s'",  md5($npassword), (int)$this->session->userdata('user_name') , md5($opassword)));
        }
        
        
        
        if($this->db->affected_rows() == 0)
            $query = $this->db->query("select * from error");
    }
}


?>