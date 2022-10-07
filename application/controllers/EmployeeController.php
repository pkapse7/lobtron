<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Master_Model');
        
        if(!$this->session->userdata("loginAdmin")){
            redirect('');
        }
    }
    public function employeeProfile(){
        $dat['title'] = 'Profile';
        $dat['profile_data'] = $this->Master_Model->get_employee_by_id();
        // echo '<pre>'; print_r($dat);exit;
        $this->load->view('links/header',$dat);
        $this->load->view('profile',$dat);
        $this->load->view('links/footer');
        
    }
     
    public function employees(){
        $dat['title'] = 'Employees';
        $this->load->view('links/header',$dat);
        $this->load->view('employee_view');
        $this->load->view('links/footer');
        $this->load->view('scripts/employee_scripts');
    }
    
    public function showEmployees() {

        $result = array('data' => array());
        $data = $this->Master_Model->get_all_employees();
            foreach ($data as $key => $value) {
                $id = $value['employeeID'];
                $edit = '<a type="button" class="btn btn-success btn-sm editRecord" data-id="'.base64_encode($id).'"  data-toggle="modal" data-target="#editModal" style="color:white;">Edit</a>';
                $delete = '<a type="button" class="btn btn-danger btn-sm deleteRecord" data-id="'.base64_encode($id).'" data-toggle="modal" data-target="#deleteModal" style="color:white;">Delete</a>';
                if($value['employee_type'] == '0'){ 
                    $type  = 'Admin';
                }else{
                    $type = 'Employee';
                }
                
                $result['data'][$key] = array(
                        $key+1,
                        $value['employee_name'],
                        $value['email'],
                        $value['department_name'],
                        $value['designation'],
                        $type,
                        'Rs. '.$value['salary'],
                        $edit."&nbsp".$delete,
                );
            } // /foreach
        echo json_encode($result);
    }

    public function selectDepartment(){
        $data = $this->Master_Model->get_all_department();
        echo json_encode($data);
    }

    public function addEmployee(){
        $this->form_validation->set_rules('employee_name', 'Employee name', 'required|trim');
        $this->form_validation->set_rules('designation', 'Designation', 'required|trim');
        $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[employee.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() === TRUE){
            $data = $this->Master_Model->insertEmployee();
            if($data == true){
                echo json_encode('success');
            }
        }else{
            $response['email_err'] = str_replace("\n","",strip_tags($this->form_validation->error_string()));
            echo json_encode('fail');
        }    
    } 

    public function checkEmail(){
       $email = $this->input->post('email');
       $data = $this->Master_Model->isEmailExist($email);
       if($data == ''){
           echo 'success';
       }else{
           echo 'fail';
       }
   }
    
    public function deleteEmployee(){
        $data=$this->Master_Model->deleteEmployee();
        echo json_encode($data);
    }
    public function getEmployeeById() {
        $empId = base64_decode($_POST['empId']);
        $data = $this->Master_Model->get_employee_by_id($empId);
        echo json_encode($data);
    }

    public function updateEmployee(){
        $this->form_validation->set_rules('employee_name', 'Employee name', 'required|trim');
        $this->form_validation->set_rules('designation', 'Designation', 'required|trim');
        $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[employee.email]');

        if($this->input->post('original_email') != $this->input->post('email')){
            if($this->form_validation->run() === TRUE){
                $data=$this->Master_Model->updateEmployee();
                if($data == true){
                    echo json_encode('success');
                }
            }else{
                $response['email_err'] = str_replace("\n","",strip_tags($this->form_validation->error_string()));
                echo json_encode('fail');
            }
        }else{
            $data=$this->Master_Model->updateEmployee();
            if($data == true){
                echo json_encode('success');
            }
        }
    }
  
}
