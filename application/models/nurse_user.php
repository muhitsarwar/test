<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class nurse_user extends CI_Model {

    public function prescription_table() {
        $query = $this->db->query(sprintf("select word_id from nurse where "
                        . "id = %d", (int) $this->session->userdata('user_name')));
        $query = $query->result_array();
        $word_id = $query[0]['word_id'];

        $query = $this->db->query(sprintf("select v2.v_id as 'Visit Id',v2.p_id as 'Patient Id',concat(pat.first_name,' ',pat.last_name) as 'Patient Name', p.m_id as 'Medicine Id',m.name as 'Medicine Name',p.time 'Time',"
                        . "p.quantity 'Quantity' from prescribed_medicine p, patient pat, "
                        . "medicine m,visit v2 "
                        . "where v2.p_id = pat.id and p.v_id = v2.v_id and p.m_id = m.id and p.nurse_check = 'NOT USED' and p.v_id "
                        . "in(select v.v_id from visit v, patient"
                        . " pa where pa.id = v.p_id and pa.word_id = %d)"
                        . "order by p.time", $word_id));
        return $query;
    }

    public function update_nurse_check($vid, $mid, $time) {

        $query = $this->db->query(sprintf("update prescribed_medicine set"
                        . " nurse_check = 'USED' where v_id = %d and m_id = %d and time = '%s'", $vid, $mid, $time));
    }
    public function cReport($pid,$fName) {

        $query = $this->db->query(sprintf("",$fName,$pid));
    }
    public function getUOperation() {

        $query = $this->db->query(sprintf("select  po.po_id 'Patient Operation Id',concat(p.first_name,' ',p.last_name)"
                        . " 'Patient Name',po.p_id 'Patient Id', o.name 'Operation', po.time 'Operation Time' "
                        . "from patient p, patient_operation po,operation o where po.po_id not in (select po_id from "
                        . "nurse_operation where "
                        . "n_id = %d) and po.o_id = o.id and p.id = po.p_id", (int) $this->session->userdata('user_name')));
        return $query;
    }

    public function getROperation() {

        $query = $this->db->query(sprintf("select  po.po_id 'Patient Operation Id',concat(p.first_name,' ',p.last_name)"
                        . " 'Patient Name',po.p_id 'Patient Id', o.name 'Operation', po.time 'Operation Time' "
                        . "from patient p, patient_operation po,operation o where po.po_id in (select po_id from "
                        . "nurse_operation where "
                        . "status = 'REQUEST' AND n_id = %d) and po.o_id = o.id and p.id = po.p_id", (int) $this->session->userdata('user_name')));
        return $query;
    }

    public function rOperation($po_id) {

        $query = $this->db->query(sprintf("INSERT INTO `hms`.`nurse_operation` (`n_id`, `po_id`, `status`) VALUES (%d, %d, 'REQUEST');", (int) $this->session->userdata('user_name'),(int) $po_id));
    }

    public function amed($mid) {
        $query = $this->db->query(sprintf("INSERT INTO `operation_medicine`(`m_id`, `po_id`, `status`) "
                . "VALUES (%d,(select max(po.po_id)  from patient_operation po , nurse_operation no where"
                . " po.po_id = no.po_id and no.n_id = %d and po.time < now() ),'NOT GRADED')", (int) $mid, (int) $this->session->userdata('user_name')));
    }
    public function aeq($eid) {
        $query = $this->db->query(sprintf("INSERT INTO `operation_equipment`(`e_id`, `po_id`, `status`) "
                . "VALUES (%d,(select max(po.po_id)  from patient_operation po , nurse_operation no where"
                . " po.po_id = no.po_id and no.n_id = %d and po.time < now() ),'NOT GRADED')", (int) $eid, (int) $this->session->userdata('user_name')));
    }
    public function search($term, $table) {

        $query = $this->db->query(sprintf("select name as label, id as value from %s where "
                        . "name like '%s%%' ", $table, $term));



        return $query->result();
    }

    public function getAOperation() {

        $query = $this->db->query(sprintf("select  po.po_id 'Patient Operation Id',concat(p.first_name,' ',p.last_name)"
                        . " 'Patient Name',po.p_id 'Patient Id', o.name 'Operation', po.time 'Operation Time' "
                        . "from patient p, patient_operation po,operation o where po.po_id in (select po_id from "
                        . "nurse_operation where "
                        . "status = 'GRADED' AND n_id = %d) and po.o_id = o.id and p.id = po.p_id", (int) $this->session->userdata('user_name')));
        return $query;
    }

    public function showProfile() {
        $query = $this->db->query(sprintf("SELECT concat(first_name,' ', last_name) name,gender,join_date jDate, phn_no pNO,word_id wNo from nurse where id = %d",(int) $this->session->userdata('user_name')));

        return $query;
    }

    public function updateProfile($pNo, $pwd, $gender) {
        if ($pNo != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`nurse` SET `PHN_NO` = '%s' WHERE `nurse`.`ID` = %d", $pNo, (int) $this->session->userdata('user_name')));
        }
        if ($pwd != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`nurse` SET `password` = '%s' WHERE `nurse`.`ID` = %d", md5($pwd), (int) $this->session->userdata('user_name')));
        }
        if ($gender != '') {
            $query = $this->db->query(sprintf("UPDATE `hms`.`nurse` SET `GENDER` = '%s' WHERE `nurse`.`ID` = %d", $gender, (int) $this->session->userdata('user_name')));
        }
    }

}

?>