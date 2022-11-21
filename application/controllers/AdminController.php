<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Master_Model');
        $this->load->library('Need_lib');


        if(!$this->session->userdata("loginAdmin") || $this->session->userdata("type") == 1){
            redirect('');
        }
    }

    public function list(){
        $dat['title'] = 'Companys';
        $this->load->view('links/header',$dat);
        $this->load->view('compony_view');
        $this->load->view('links/footer');
        $this->load->view('scripts/company_scripts');
    }

    public function showCompany() {
        $result = array('data' => array());
        $data = $this->Master_Model->get_all_companies();
            foreach ($data as $key => $value) {
                $id = $value['companyID'];
                $edit = '<a type="button" class="btn btn-success btn-sm editRecord" data-id="'.base64_encode($id).'"  data-toggle="modal" data-target="#editModal" style="color:white;">Edit</a>';
                $delete = '<a type="button" class="btn btn-danger btn-sm deleteRecord" data-id="'.base64_encode($id).'" data-toggle="modal" data-target="#deleteModal" style="color:white;">Delete</a>';
                if($value['status'] == '0'){
                    $type  = 'Active';
                }else{
                    $type = 'Inactive';
                }

                $result['data'][$key] = array(
                        $key+1,
                        $value['company_name'],
                        $value['phone'],
                        $value['email'],
                        $value['website'],
                        $value['address'],
                        $type,
                        $edit."&nbsp".$delete,
                );
            } // /foreach
        echo json_encode($result);
    }

    public function addCompany(){
        $file = $_FILES['photo']['name'] ;

        $this->form_validation->set_rules('company_name', 'Company name', 'required|trim|is_unique[company.company_name]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|is_unique[company.phone]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[company.email]');
        $this->form_validation->set_rules('website', 'Website', 'required|trim|valid_url');

        if(!empty($this->input->post('password') && $this->input->post('passconf'))) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|trim|matches[password]');
        }
        if($this->form_validation->run() === TRUE){
            $file = $_FILES['photo']['name'];
            $tmp_file = $_FILES['photo']['tmp_name'];
            $path = './assets/uploads/company/';
            $lib = $this->need_lib->upload_file($file, $tmp_file, $path);
            $photo = (!empty($file)) ? 'assets/uploads/company/'.$lib : "";

            $data = array(
                'company_name' => $this->input->post('company_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'address' => $this->input->post('address'),
                'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
                'photo' => $photo,
                'status'=> $this->input->post('status'),
                'login_type' => 1,
            );
            $data = $this->security->xss_clean($data);

            $data = $this->Master_Model->insertCompany($data);
            if($data == true){
                echo json_encode('success');
            }
        }else{
            $response = str_replace("\n","",strip_tags($this->form_validation->error_string()));
            echo json_encode($response);
        }
    }

    public function deleteCompany(){
        $data=$this->Master_Model->deleteCompany();
        echo json_encode($data);
    }

    public function getCompanyById() {
        $comId = base64_decode($_POST['comId']);
        $data = $this->Master_Model->get_company_by_id($comId);

        echo json_encode($data);
    }

    public function updateCompany(){
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

        if(!empty($this->input->post('password') && $this->input->post('passconf'))) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|trim|matches[password]');
        }

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

            if(!empty($this->input->post('password'))){
              $data['password'] = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
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

    //for contacts list
    public function contactList(){
        $dat['title'] = 'Contacts';
        $this->load->view('links/header',$dat);
        $this->load->view('contacts_list_view');
        $this->load->view('links/footer');
        $this->load->view('scripts/company_scripts');
    }

    public function showContactList() {
        $result = array('data' => array());
        $data = $this->Master_Model->get_all_contacts();
        // echo '<pre>'; print_r($data);exit;
            foreach ($data as $key => $value) {
                if($value['status'] == '0'){
                    $type  = 'Active';
                }else{
                    $type = 'Inactive';
                }

                $photo = '<img src="'.base_url().$value['photo'].'"  style="width:100px;height:130px" />';

                $result['data'][$key] = array(
                        $value['company_name'],
                        $value['first_name'],
                        $value['last_name'],
                        $value['email'],
                        $value['phone'],
                        $value['address'],
                        $photo,
                        $type,
                );
            } // /foreach
        echo json_encode($result);
    }
}
