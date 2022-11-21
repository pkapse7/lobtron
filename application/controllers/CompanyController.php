<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Master_Model');
        $this->load->library('Need_lib');


        if(!$this->session->userdata("loginAdmin") || $this->session->userdata("type") == 0){
            redirect('');
        }
    }

    public function list(){
        $dat['title'] = 'Contacts';
        $this->load->view('links/header',$dat);
        $this->load->view('contacts_view');
        $this->load->view('links/footer');
        $this->load->view('scripts/contact_scripts');
    }

    public function showContacts() {
        $result = array('data' => array());
        $data = $this->Master_Model->get_all_contacts();
        // echo '<pre>'; print_r($data);exit;
            foreach ($data as $key => $value) {
                $id = $value['contactID'];
                $edit = '<a type="button" class="btn btn-success btn-sm editRecord" data-id="'.base64_encode($id).'"  data-toggle="modal" data-target="#editModal" style="color:white;">Edit</a>';
                $delete = '<a type="button" class="btn btn-danger btn-sm deleteRecord" data-id="'.base64_encode($id).'" data-toggle="modal" data-target="#deleteModal" style="color:white;">Delete</a>';
                if($value['status'] == '0'){
                    $type  = 'Active';
                }else{
                    $type = 'Inactive';
                }

                $photo = '<img src="'.base_url().$value['photo'].'"  style="width:100px;height:130px" />';

                $result['data'][$key] = array(
                        $key+1,
                        $value['first_name'],
                        $value['last_name'],
                        $value['email'],
                        $value['phone'],
                        $value['address'],
                        $photo,
                        $type,
                        $edit."&nbsp".$delete,
                );
            } // /foreach
        echo json_encode($result);
    }

    public function addContact(){
        $file = $_FILES['photo']['name'] ;

        $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|is_unique[contacts.phone]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[contacts.email]');

        if($this->form_validation->run() === TRUE){
            $file = $_FILES['photo']['name'];
            $tmp_file = $_FILES['photo']['tmp_name'];
            $path = './assets/uploads/contact/';
            $lib = $this->need_lib->upload_file($file, $tmp_file, $path);
            $photo = (!empty($file)) ? 'assets/uploads/contact/'.$lib : "";

            $data = array(
                'company_id' => $this->session->userdata('login_id'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'photo' => $photo,
                'status'=> $this->input->post('status'),
            );
            $data = $this->security->xss_clean($data);

            $data = $this->Master_Model->insertContact($data);
            if($data == true){
                echo json_encode('success');
            }
        }else{
            $response = str_replace("\n","",strip_tags($this->form_validation->error_string()));
            echo json_encode($response);
        }
    }

    public function deleteContact(){
        $data=$this->Master_Model->deleteContact();
        echo json_encode($data);
    }

    public function getContactById() {
        $conId = base64_decode($_POST['conId']);
        $data = $this->Master_Model->get_contact_by_id($conId);

        echo json_encode($data);
    }

    public function updateContact(){
        $id= $this->input->post('contactID');
        if($this->input->post('email') != $this->input->post('original_email')) {
           $is_unique =  '|is_unique[contacts.email]';
        } else {
           $is_unique =  '';
        }
        if($this->input->post('phone') != $this->input->post('original_phone')) {
           $is_unique2 =  '|is_unique[contacts.phone]';
        } else {
           $is_unique2 =  '';
        }
          $this->form_validation->set_rules('first_name', 'First name', 'required|trim');
          $this->form_validation->set_rules('last_name', 'Last name', 'required|trim');
          $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|xss_clean'.$is_unique2);
          $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean'.$is_unique);

        if($this->form_validation->run() === TRUE){
            $file = $_FILES['photo']['name'];
            $tmp_file = $_FILES['photo']['tmp_name'];
            $path = './assets/uploads/company/';
            $lib = $this->need_lib->upload_file($file, $tmp_file, $path);
            $photo = 'assets/uploads/company/'.$lib;


            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'status'=> $this->input->post('status'),
            );

            if(!empty($_FILES['photo']['name'])){
              $data['photo'] = $photo;
            }
            $data = $this->security->xss_clean($data);

            $data = $this->Master_Model->updateContact($id,$data);
            if($data == true){
                echo json_encode('success');
            }
        }else{
            $response = str_replace("\n","",strip_tags($this->form_validation->error_string()));
            echo json_encode($response);
        }
    }

    public function companyProfile(){
        $dat['title'] = 'Profile';
        $data['profile'] = $this->Master_Model->getCompanyData();
        // echo '<pre>'; print_r($data);exit;
        $this->load->view('links/header',$dat);
        $this->load->view('profile_view',$data);
        $this->load->view('links/footer');
        $this->load->view('scripts/contact_scripts');
    }

    public function updateCompanyProfile(){
        $id= $this->input->post('companyID');
        if($this->input->post('company_name') != $this->input->post('original_name')) {
           $is_unique =  '|is_unique[company.company_name]';
        } else {
           $is_unique =  '';
        }
        if($this->input->post('email') != $this->input->post('original_email')) {
           $is_unique1 =  '|is_unique[company.email]';
        } else {
           $is_unique1 =  '';
        }
        if($this->input->post('phone') != $this->input->post('original_phone')) {
           $is_unique2 =  '|is_unique[company.phone]';
        } else {
           $is_unique2 =  '';
        }

        $this->form_validation->set_rules('company_name', 'Company name','required|trim|xss_clean'.$is_unique);
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|xss_clean'.$is_unique2);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean'.$is_unique1);
        $this->form_validation->set_rules('website', 'Website', 'required|trim|valid_url');


        if($this->form_validation->run() === TRUE){
            $file = $_FILES['photo']['name'];
            $tmp_file = $_FILES['photo']['tmp_name'];
            $path = './assets/uploads/company/';
            $lib = $this->need_lib->upload_file($file, $tmp_file, $path);
            $photo = 'assets/uploads/company/'.$lib;


            $data = array(
                'company_name' => $this->input->post('company_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'address' => $this->input->post('address'),
                'status'=> $this->input->post('status'),
            );

            if(!empty($_FILES['photo']['name'])){
              $data['photo'] = $photo;
            }
            $data = $this->security->xss_clean($data);

            $data = $this->Master_Model->updateCompany($id,$data);
            if($data == true){
                echo json_encode('success');
            }
        }else{
            $response = str_replace("\n","",strip_tags($this->form_validation->error_string()));
            echo json_encode($response);
        }
    }

}
