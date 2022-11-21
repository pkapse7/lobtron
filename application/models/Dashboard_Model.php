<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {

    function __construct(){
            parent::__construct();
    }

    public function isUserExist($username){
        try{
            $this->db->select('companyID');
            $this->db->from('company');
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
            $this->db->select('companyID, company_name, email, login_type, password');
            $this->db->from('company');
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

    

}
