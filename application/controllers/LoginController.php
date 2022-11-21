
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Dashboard_Model');
    }

    public function index(){

        $username = $this->input->post('email');
        $password = $this->input->post('password');

        if($username != '' && $password != ''){
            if($this->Dashboard_Model->isUserExist($username)){
                $getpass=$this->Dashboard_Model->getPass($username);
                if(password_verify($password ,$getpass["password"])) {
                    $session_data=array(
                        'login_id' =>$getpass["companyID"],
                        'name' =>$getpass["company_name"],
                        'username' =>$username,
                        'type' =>$getpass["login_type"],
                        'loginAdmin' =>TRUE //boolean value TRUE
                    );
                    $this->session->set_userdata($session_data);
                    redirect('');

                }else{
                    $this->session->set_flashdata('error_msg','Password does not match.');
                    redirect('');
                }
            }else{
                $this->session->set_flashdata('error_msg',"User does not exists.");
                redirect('');
            }
        }else{
            $this->session->set_flashdata('error_msg',"Username and password are required.");
            redirect('');
        }

    }

    public function signout(){
        $this->session->unset_userdata("admin_id");
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("loginAdmin");

        $this->session->sess_destroy();
        redirect('');
    }

}
