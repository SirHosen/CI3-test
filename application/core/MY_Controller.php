<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Cek apakah user login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Cek apakah akun masih aktif
        $this->load->model('user_model');
        $user_id = $this->session->userdata('user_id');
        
        if (!$this->user_model->check_user_status($user_id)) {
            // Akun dinonaktifkan, logout otomatis
            $this->session->unset_userdata(array('user_id', 'username', 'email', 'full_name', 'role', 'logged_in'));
            $this->session->sess_destroy();
            $this->session->set_flashdata('error', 'Akun Anda telah dinonaktifkan oleh administrator. Silakan hubungi admin untuk informasi lebih lanjut.');
            redirect('auth/login');
        }
    }
}

class Admin_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Cek role admin
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman admin!');
            redirect('dashboard');
        }
    }
}
