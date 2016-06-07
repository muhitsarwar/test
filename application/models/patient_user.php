<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class patient_user extends CI_Model {

    public function show_reportr() {
        $query = $this->db->query(sprintf("select t.cost 'cost', t.name tName,concat(d.first_name,' ',d.last_name) "
                        . "dName,v.date vDate,pt.report tReport from prescribed_test pt,test t,doctor d,visit v "
                        . "where pt.report <> '' and pt.report is not null and v.p_id = %d and pt.t_id = t.id and v.v_id = pt.v_id and v.d_id = "
                        . "d.id", (int) $this->session->userdata('user_name')));
        return $query;
    }

    public function show_reportw() {
        $query = $this->db->query(sprintf("select t.cost 'cost', t.name tName,concat(d.first_name,' ',d.last_name) "
                        . "dName,v.date vDate,pt.report tReport from prescribed_test pt,test t,doctor d,visit v "
                        . "where (pt.report = '' or pt.report is null) and v.p_id = %d and pt.t_id = t.id and v.v_id = pt.v_id and v.d_id = "
                        . "d.id", (int) $this->session->userdata('user_name')));
        return $query;
    }

    public function med_now($pid) {

        $query = $this->db->query(sprintf("select v.d_id as doctor,m.name as medicine,p.time,"
                        . "p.quantity,p.nurse_check as count,m.cost from "
                        . "prescription p,visit v,medicine m "
                        . "where p.v_id in(select v_id from visit "
                        . "where p_id = %d) and p.v_id = v.v_id "
                        . "and p.m_id = m.id "
                        . "and p.nurse_check = 0 and p.time <= now()"
                        . "order by p.time", $pid));

        return $query;
    }

    public function showInfo() {

        $query = $this->db->query(sprintf("select id 'pid',concat(first_name,' ',last_name)"
                        . " 'name', gender, admission_date 'adate',word_id 'wno' from patient where id = %d", (int) $this->session->userdata('user_name')));

        return $query;
    }
    public function getPOperation() {

        $query = $this->db->query(sprintf("select o.name 'Operation', po.time"
                . " 'Time', o.cost 'Cost' from patient_operation po , operation o where po.o_id = o.id"
                . " and p_id = %d and po.time < curtime() ", (int) $this->session->userdata('user_name')));

        return $query;
    }
    
    public function getUOperation() {

        $query = $this->db->query(sprintf("select  o.name 'Operation', po.time"
                . " 'Time', o.cost 'Cost' from patient_operation po , operation o where po.o_id = o.id"
                . " and p_id = %d and po.time > curtime() ", (int) $this->session->userdata('user_name')));

        return $query;
    }

    public function umed($pid) {

        $query = $this->db->query(sprintf("select v.d_id 'Doctor Id',m.name as 'Medicine',p.time 'Time',"
                        . "p.quantity 'Quantity',m.cost 'Cost' from "
                        . "prescribed_medicine p,visit v,medicine m "
                        . "where p.v_id in(select v_id from visit "
                        . "where p_id = %d) and p.v_id = v.v_id "
                        . "and p.m_id = m.id and p.nurse_check = 'USED' "
                        . "order by p.time ", $pid));

        return $query;
    }

    public function tbumed($pid) {

        $query = $this->db->query(sprintf("select v.d_id 'Doctor Id',m.name as 'Medicine',p.time 'Time',"
                        . "p.quantity 'Quantity',m.cost 'Cost' from "
                        . "prescribed_medicine p,visit v,medicine m "
                        . "where p.v_id in(select v_id from visit "
                        . "where p_id = %d) and p.v_id = v.v_id "
                        . "and p.m_id = m.id and p.nurse_check = 'NOT USED'"
                        . "order by p.time ", $pid));

        return $query;
    }

    public function test_data($pid) {

        $query = $this->db->query(sprintf("select v.date ,t.name as test,tr.report,"
                        . "t.cost from "
                        . "testreport tr,visit v,test t "
                        . "where tr.v_id in(select v_id from visit "
                        . "where p_id = %d) and tr.v_id = v.v_id "
                        . "and t.id = tr.t_id "
                        . "order by v.date", $pid));

        return $query;
    }

    public function operation_data($pid) {

        $query = $this->db->query(sprintf("select s.name as surgery,op.d_id,op.date,s.cost as cost "
                        . "from operation op,surgery s where op.p_id = %d and op.s_id = s.id", $pid));

        return $query;
    }



}

?>