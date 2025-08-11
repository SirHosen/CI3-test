<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('user_model');
    }
    
    public function index() {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->user_model->get_user($this->session->userdata('user_id'));
        $data['active_users'] = $this->user_model->get_active_users();
        $data['statistics'] = $this->user_model->get_user_statistics();
        $data['logs'] = $this->user_model->get_user_logs($this->session->userdata('user_id'));
        
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
