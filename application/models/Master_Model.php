<?php

class Master_Model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function isEmailExist($email){
        try{
            $this->db->select('email');
            $this->db->from('employee');
            $this->db->where('email',$email);
            $query=$this->db->get();
            $story_array = array();
            if($this->db->affected_rows() > 0){
                $story_array = $query->row();
                return $story_array;
            }else{
                return false;
            }
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    //company
    public function insertCompany($data){
        try{
            $this->db->insert('company', $data);
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

    public function get_all_companies() {
        try{
            $this->db->where('login_type',1);
            $query =$this->db->get('company');
            return $query->result_array();
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function get_company_by_id($comId) {
        try{
            $this->db->select('company_name,phone,website,address,email,photo,status');
            $this->db->from('company');
            $this->db->where('companyID',$comId);
            $query =$this->db->get();
            $array = array();
            if($this->db->affected_rows() > 0) {
                $array = $query->row();
            }
            return $array;
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function updateCompany($id,$data) {
        try {
            $this->db->where('companyID', base64_decode($id));
            if($this->db->update('company',$data)){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (Exception $exc) {
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function deleteCompany(){
        try{
            $id = base64_decode($_POST['companyID']);
            $this->db->where('companyID', $id);
            return $this->db->delete('company');
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
      }
   }

   //contatcs
   public function insertContact($data){
       try{
           $this->db->insert('contacts', $data);
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

   public function get_all_contacts() {
       try{
           $this->db->select('contacts.contactID,contacts.first_name,contacts.last_name,contacts.phone,contacts.address, contacts.photo,contacts.email,contacts.status,company.company_name');
           $this->db->from('contacts');
           $this->db->join('company','company.companyID=contacts.company_id','LEFT');
           if($this->session->userdata('type') == 1){
             $this->db->where('company.companyID',$this->session->userdata('login_id'));
           }
           $query =$this->db->get();
           return $query->result_array();
       }catch(Exception $ex){
           error_log($ex->getTraceAsString());
           echo $ex->getTraceAsString();
           return FALSE;
       }
   }

   public function get_contact_by_id($conId) {
       try{
           $this->db->select('first_name,phone,last_name,address,email,photo,status');
           $this->db->from('contacts');
           $this->db->where('contactID',$conId);
           $query =$this->db->get();
           $array = array();
           if($this->db->affected_rows() > 0) {
               $array = $query->row();
           }
           return $array;
       }catch(Exception $ex){
           error_log($ex->getTraceAsString());
           echo $ex->getTraceAsString();
           return FALSE;
       }
   }

   public function updateContact($id,$data) {
       try {
           $this->db->where('contactID', base64_decode($id));
           if($this->db->update('contacts',$data)){
               return TRUE;
           }else{
               return FALSE;
           }

       } catch (Exception $exc) {
           error_log($ex->getTraceAsString());
           echo $ex->getTraceAsString();
           return FALSE;
       }
   }

   public function deleteContact(){
       try{
           $id = base64_decode($_POST['contactID']);
           $this->db->where('contactID', $id);
           return $this->db->delete('contacts');
       }catch(Exception $ex){
           error_log($ex->getTraceAsString());
           echo $ex->getTraceAsString();
           return FALSE;
     }
  }

  public function getCompanyData(){
      try{
          $this->db->select('companyID,company_name,phone,website,address,email,photo,status');
          $this->db->from('company');
          $this->db->where('companyID',$this->session->userdata('login_id'));
          // if($this->session->userdata('type')==1){
          //     $this->db->where('employee.employeeID',$this->session->userdata('login_id'));
          // }else{
          //     $this->db->where('employee.employeeID',$empId);
          // }

          $query = $this->db->get();

          $array = array();
          if($this->db->affected_rows() > 0) {
              $array = $query->row();
          }
          return $array;
      }catch(Exception $ex) {
          error_log($ex->getTraceAsString());
          echo $ex->getTraceAsString();
          return FALSE;
      }
  }
}
