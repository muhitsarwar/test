<?php

class doctor_user extends CI_Model {

    public function search($term, $table) {
        if ($table == 'patient')
            $query = $this->db->query(sprintf("select concat(first_name,' ',last_name) as label, id as value from patient where "
                            . "first_name like '%s%%' or last_name like '%%%s%%' ", $term, $term));
        else
            $query = $this->db->query(sprintf("select name as label, id as value from %s where "
                            . "name like '%s%%' ", $table, $term));



        return $query->result();
    }

    public function addmedicine($mid, $time, $quan, $pid) {
        $query = $this->db->query(sprintf("select * from visit where p_id = %d and d_id = %d",(int)$pid,(int)$this->session->userdata('user_name')));
        if(!($query != NULL && $query->num_rows() == 1)){
             $query = $this->db->query(sprintf("INSERT INTO `hms`.`visit` (`DATE`, `V_ID`, `D_ID`, `P_ID`) VALUES (current_date(), NULL, %d, %d);",(int)$this->session->userdata('user_name'),(int)$pid));
        }
        $query = $this->db->query(sprintf("INSERT INTO `hms`.`prescribed_medicine` (`M_ID`, `TIME`, `V_ID`, `QUANTITY`,`nurse_check`)"
                        . " VALUES (%d, '%s',(select max(v_id) from visit where"
                        . " d_id = %d and p_id = %d ) , %d,'NOT USED')", $mid, $time, (int) $this->session->userdata('user_name'), (int) $pid, $quan));
    }

    public function updateProfile($pNo, $pwd, $gender, $speciality) {
        if ($pNo != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`doctor` SET `PHN_NO` = '%s' WHERE `doctor`.`ID` = %d", $pNo, (int) $this->session->userdata('user_name')));
        }
        if ($pwd != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`doctor` SET `password` = '%s' WHERE `doctor`.`ID` = %d", md5($pwd), (int) $this->session->userdata('user_name')));
        }
        if ($gender != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`doctor` SET `GENDER` = '%s' WHERE `doctor`.`ID` = %d", $gender, (int) $this->session->userdata('user_name')));
        }
        if ($speciality != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`doctor` SET `SPECIALITY` = '%s' WHERE `doctor`.`ID` = %d", $speciality, (int) $this->session->userdata('user_name')));
        }
    }

    public function addsurgery($pid, $sid, $date) {
        $query = $this->db->query(sprintf("INSERT INTO `test`.`operation` (`DATE`, `P_ID`, `D_ID`, `S_ID`)"
                        . " VALUES ('%s', %d, %d, %d)", $date, (int) $pid, (int) $this->session->userdata('user_name'), (int) $sid));
    }

    public function addtest($pid, $tid) {
        $query = $this->db->query(sprintf("select v_id from visit where d_id = %d and p_id = %d and date = curdate()", (int) $this->session->userdata('user_name'), (int) $pid));
        if ($query->num_rows() != 1) {
            $this->db->query(sprintf("INSERT INTO visit(d_id, p_id, date) VALUES (%d, %d, curdate())", (int) $this->session->userdata('user_name'), (int) $pid));
        }


        $query = $this->db->query(sprintf("INSERT INTO prescribed_test (T_ID, V_ID)"
                        . " VALUES (%d,(select v_id from visit where d_id = %d and p_id = %d and date = curdate()) )", (int) $tid, (int) $this->session->userdata('user_name'), $pid));
    }

    public function adddoctor($pid, $oid, $did, $time) {
        $query = $this->db->query(sprintf("select po_id from patient_operation where p_id = %d"
                        . " and o_id = %d and time = '%s'", (int) $pid, (int) $oid, $time));
        if ($query->num_rows() != 1) {
            $this->db->query(sprintf("INSERT INTO `hms`.`patient_operation` (`P_ID`, `O_ID`, `po_id`, `TIME`, `status`)"
                            . " VALUES (%d, %d, NULL, '%s', 'upcoming')", (int) $pid, (int) $oid, $time));
        }

        $query = $this->db->query(sprintf("INSERT INTO `hms`.`doctor_operation` (`d_id`, `po_id`) VALUES (%d, (select po_id from patient_operation where p_id = %d"
                        . " and o_id = %d and time = '%s'))", (int) $did, (int) $pid, (int) $oid, $time));
    }

    public function getNurse() {

        $query = $this->db->query(sprintf("select  concat(n.first_name,' ' ,n.last_name)"
                        . " 'Nurse Name', n.id 'Nurse Id', po.time 'Operation Time',po.po_id 'PATIENT OPERATION ID', o.name 'Operation Name' from operation o,"
                        . " nurse n, nurse_operation no, patient_operation po, doctor_operation do "
                        . "where po.po_id = do.po_id and po.po_id = no.po_id and n.id = no.n_id "
                        . "and do.d_id = %d and o.id = po.o_id and no.status = 'REQUEST'", (int) $this->session->userdata('user_name')));
        return $query;
    }
    
    public function aNurse($po_id, $n_id){
        $query = $this->db->query(sprintf("update nurse_operation set status = 'GRADED' where n_id = %d and po_id = %d",(int)$n_id,(int)$po_id));
    }
    public function aMed($po_id, $m_id){
        $query = $this->db->query(sprintf("update operation_medicine set status = 'GRADED' where m_id = %d and po_id = %d",(int)$m_id,(int)$po_id));
    }
    
    public function aEq($po_id, $e_id){
        $query = $this->db->query(sprintf("update operation_equipment set status = 'GRADED' where e_id = %d and po_id = %d",(int)$e_id,(int)$po_id));
    }
    
    public function prescription_table($pid) {

        $query = $this->db->query(sprintf("SELECT M.NAME 'MEDICINE NAME',PM.TIME 'TIME',PM.NURSE_CHECK 'USAGE' FROM VISIT V,PRESCRIBED_MEDICINE PM,MEDICINE M WHERE V.P_ID = %d AND V.V_ID = PM.V_ID AND M.ID = PM.M_ID", (int) $pid));
        return $query;
    }

    public function show_report($pid) {
        $query = $this->db->query(sprintf("select t.name tName,concat(d.first_name,' ',d.last_name) "
                        . "dName,v.date vDate,pt.report tReport from prescribed_test pt,test t,doctor d,visit v "
                        . "where v.p_id = %d and pt.t_id = t.id and v.v_id = pt.v_id and v.d_id = "
                        . "d.id", (int) $pid));
        return $query;
    }

    public function showProfile() {
        $query = $this->db->query(sprintf("SELECT concat(first_name,' ', last_name) name,gender,join_date jDate, phn_no pNO from doctor"));

        return $query;
    }

    public function patientInfo($pid) {
        $query = $this->db->query(sprintf("select concat(first_name ,' ', last_name) name, "
                        . "admission_date aDate, word_id word,gender, phn_no phn from patient where id = %d", $pid));

        return $query;
    }

    
    public function uEq(){
        $query = $this->db->query(sprintf("select e.name 'Eq Name', e.id 'Eq Id', po.time 'Operation Time',po.po_id 'PATIENT OPERATION ID', o.name "
                . "'Operation Name' from operation o, equipment e, operation_equipment oe, "
                . "patient_operation po, doctor_operation do where po.po_id = do.po_id and"
                . " po.po_id = oe.po_id and e.id = oe.e_id and do.d_id = %d and o.id = "
                . "po.o_id and oe.status = 'NOT GRADED'", (int) $this->session->userdata('user_name')));
        return $query;
    }
    public function uMed() {
        $query = $this->db->query(sprintf("select m.name 'Med Name', m.id 'Med Id', po.time 'Operation Time',po.po_id 'PATIENT OPERATION ID', o.name 'Operation Name' from operation o, medicine m, operation_medicine om, patient_operation po, doctor_operation do where po.po_id = do.po_id and po.po_id = om.po_id "
                . "and m.id = om.m_id and do.d_id = %d and o.id = po.o_id and om.status = 'NOT GRADED'", (int) $this->session->userdata('user_name')));
        return $query;
    }

}

?>