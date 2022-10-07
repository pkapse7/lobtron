<?php

class Master_Model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    public function get_employee_by_id($empId=''){
        try{
            $this->db->select('employee.employeeID,employee.employee_name,employee.salary,employee.designation,employee.employee_type,employee.email,employee.departmentID,department.department_name');
            $this->db->from('employee');
            $this->db->join('department','department.departmentID=employee.departmentID','LEFT');
            if($this->session->userdata('type')==1){
                $this->db->where('employee.employeeID',$this->session->userdata('login_id'));
            }else{
                $this->db->where('employee.employeeID',$empId);
            }
            
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
    
    
    public function get_all_employees() {
        try{
            $this->db->select('employee.employeeID,employee.employee_name,employee.salary,employee.designation,employee.employee_type,employee.email,department.department_name');
            $this->db->from('employee');
            $this->db->join('department','department.departmentID=employee.departmentID','LEFT');
            $this->db->where('employee.employee_type', 1);
            $query =$this->db->get();
            return $query->result_array();
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function get_all_department() {
        try{
            $query =$this->db->get('department');
            return $query->result_array();
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function insertEmployee(){
        try{
            $data = array(
                'employee_name' => $this->input->post('employee_name'),
                'designation' => $this->input->post('designation'),
                'departmentID' => $this->input->post('departmentID'),
                'employee_type' => $this->input->post('employee_type'),
                'salary' => $this->input->post('salary'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
            );
            $data = $this->security->xss_clean($data);
            $this->db->insert('employee', $data);
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
    
    public function deleteEmployee(){
        try{
            $id = base64_decode($_POST['employeeID']);
            $this->db->where('employeeID', $id);
            return $this->db->delete('employee');
        }catch(Exception $ex){
            error_log($ex->getTraceAsString());
            echo $ex->getTraceAsString();
            return FALSE;
        }
    }

    public function updateEmployee() {
        try {
            $data = array(
                'employee_name' => $this->input->post('employee_name'),
                'designation' => $this->input->post('designation'),
                'departmentID' => $this->input->post('departmentID'),
                'employee_type' => $this->input->post('employee_type'),
                'salary' => $this->input->post('salary'),
                'email' => $this->input->post('email'),
            );
            $data = $this->security->xss_clean($data);
            $this->db->where('employeeID', base64_decode($this->input->post('employeeID')));
            if($this->db->update('employee',$data)){
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
    
}    