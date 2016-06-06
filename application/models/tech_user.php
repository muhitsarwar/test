<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class tech_user extends CI_Model {

    public function search($term, $table) {

        if ($table == 'patient')
            $query = $this->db->query(sprintf("select concat(first_name,' ',last_name) as label, id as value from patient where "
                            . "first_name like '%s%%' or last_name like '%%%s%%' ", $term, $term));
        else
            $query = $this->db->query(sprintf("select name as label, id as value from %s where "
                            . "name like '%s%%' ", $table, $term));



        return $query->result();
    }

    public function showProfile() {
        $query = $this->db->query(sprintf("SELECT concat(first_name,' ', last_name) name,gender,join_date jDate, phn_no pNO,t_id wNo from tech where id = %d", (int) $this->session->userdata('user_name')));

        return $query;
    }

    public function show_report() {
        $query = $this->db->query("select v.p_id as 'patient id',t.name as 'test',tr.report as 'report' from visit v, testreport tr,test t where v.v_id = tr.v_id and tr.t_id = t.id");
        return $query;
    }
    
    public function showTestField() {
        $query = $this->db->query(sprintf("select name 'tField' from test_field where t_id in (select t_id from tech where id = %d)", (int) $this->session->userdata('user_name')));
        
        return $query;
    }
    
    public function cReport($pid,$fName) {

        $query = $this->db->query(sprintf("update prescribed_test set report = '%s' where v_id in(select v_id from visit where p_id = %d order by date) and t_id = (select t_id from tech where id = %d)  and (report = '' or report is null)",$fName,(int)$pid,(int) $this->session->userdata('user_name')));
    }
    
    public function updateProfile($pNo, $pwd, $gender) {
        if ($pNo != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`tech` SET `PHN_NO` = '%s' WHERE `tech`.`ID` = %d", $pNo, (int) $this->session->userdata('user_name')));
        }
        if ($pwd != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`tech` SET `password` = '%s' WHERE `tech`.`ID` = %d", md5($pwd), (int) $this->session->userdata('user_name')));
        }
        if ($gender != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`tech` SET `GENDER` = '%s' WHERE `tech`.`ID` = %d", $gender, (int) $this->session->userdata('user_name')));
        }
    }
    
    public function addreport($pid, $tid, $report) {
        $query = $this->db->query(sprintf("call report_update(%d,%d,'%s');", $tid, $pid, $report));
    }

}

?>