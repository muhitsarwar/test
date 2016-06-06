<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class recp_user extends CI_Model {
    public function release_add($pid){
        $query = $this->db->query(sprintf("update patient set release_date = curdate() where id = %d",$pid));
        
    }
    
    public function prelease($pid){
        $this->db->query(sprintf("delete from doctor_operation where po_id in (select po_id from patient_operation where p_id = %d)",(int)$pid));
        $this->db->query(sprintf("delete from nurse_operation where po_id in (select po_id from patient_operation where p_id = %d)",(int)$pid));
        $this->db->query(sprintf("delete from operation_medicine where po_id in (select po_id from patient_operation where p_id = %d)",(int)$pid));
        $this->db->query(sprintf("delete from operation_equipment where po_id in (select po_id from patient_operation where p_id = %d)",(int)$pid));
        $this->db->query(sprintf("delete from patient_operation where p_id = %d",(int)$pid));
        
        $this->db->query(sprintf("delete from prescribed_medicine where v_id in (select v_id from visit where p_id = %d)",(int)$pid));
        $this->db->query(sprintf("delete from prescribed_test where v_id in (select v_id from visit where p_id = %d)",(int)$pid));
       $this->db->query(sprintf("delete from visit where p_id = %d",(int)$pid));
        
        $this->db->query(sprintf("delete from patient where id = %d",(int)$pid));
        
        
        
    }
    
    public function showProfile() {
        $query = $this->db->query(sprintf("SELECT concat(first_name,' ', last_name) name,gender,join_date jDate, phn_no pNO from recp where id = %d",(int) $this->session->userdata('user_name')));

        return $query;
    }
    
    public function updateProfile($pNo, $pwd, $gender) {
        if ($pNo != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`recp` SET `PHN_NO` = '%s' WHERE `recp`.`ID` = %d", $pNo, (int) $this->session->userdata('user_name')));
        }
        if ($pwd != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`recp` SET `password` = '%s' WHERE `recp`.`ID` = %d", md5($pwd), (int) $this->session->userdata('user_name')));
        }
        if ($gender != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`recp` SET `GENDER` = '%s' WHERE `recp`.`ID` = %d", $gender, (int) $this->session->userdata('user_name')));
        }
    }
    public function search($term, $col) {
        $query = $this->db->query(sprintf("select distinct(%s) as label from address where "
                        . "%s like '%s%%' ", $col, $col, $term));
        return $query->result();
    }

    public function addpatient($fname, $lname, $pNo, $gender, $wNo, $hight, $weight) {
        $query = $this->db->query(sprintf("INSERT INTO `hms`.`patient` "
                . "(`ID`, `FIRST_NAME`, `LAST_NAME`, `PHN_NO`, `GENDER`, "
                . "`ADMISSION_DATE`, `RELEASE_DATE`, `ADDRESS_ID`, `WORD_ID`, `password`, "
                . "`hight`, `weight`) VALUES (NULL, '%s', '%s', '%s', '%s', "
                . "curdate(), NULL, NULL, %d, '', %d, %d);", $fname, $lname, $pNo, $gender, (int)$wNo, (int)$hight, (int)$weight));
         
        
        $query = $this->db->query(sprintf("select id from patient where first_name = '%s' and last_name = '%s' and phn_no = '%s' and admission_date = curdate()",$fname,$lname,$pNo));
        return $query;
    }

}

?>