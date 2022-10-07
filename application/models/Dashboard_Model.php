<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {

    function __construct(){
            parent::__construct();
    }

    public function isUserExist($username){
        try{
            $this->db->select('employeeID');
            $this->db->from('employee');
            $this->db->where('email',$username);

            $query=$this->db->get();
                if($this->db->affected_rows() > 0){
                    return true;
                }else{
                    return false;
                }
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function getPass($username){
     	try{     
            $this->db->select('employeeID, employee_name, email, employee_type, password');
            $this->db->from('employee');
            $this->db->where('email',$username);

            $query=$this->db->get();
                if($this->db->affected_rows() > 0){
                    return $query->row_array();
                }else{
                    return 0;
                }
     	}catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
     	}
    }

    public function get_no_of_employees() {
        try{
            $query =$this->db->get('employee');
            return $query->num_rows();
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }
    
}
