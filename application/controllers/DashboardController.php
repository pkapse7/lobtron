<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Dashboard_Model');
    }
    
    public function index(){
        if($this->session->userdata("loginAdmin")){
            $dat['title'] = 'Dashboard';
            $dat['no_of_employees']=$this->Dashboard_Model->get_no_of_employees();   
            $this->load->view('links/header',$dat);
            $this->load->view('dashboard_view');
            $this->load->view('links/footer');
            $this->load->view('scripts/dashboard_scripts');
        }else{
            $dat['title'] = ' Login';
            $this->load->view('login/login_view',$dat);
        }
        
    }

}
