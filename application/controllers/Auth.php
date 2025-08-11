<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        redirect('auth/login');
    }
    
    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        
        $data['title'] = 'Login';
        $this->load->view('auth/login', $data);
    }
    
    public function login_process() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            
            $result = $this->user_model->login($username, $password);
            
            if ($result['status'] == 'success') {
                $user = $result['user'];
                $session_data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'full_name' => $user->full_name,
                    'role' => $user->role,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                
                $this->session->set_flashdata('success', 'Login berhasil!');
                redirect('dashboard');
                
            } elseif ($result['status'] == 'inactive') {
                // Akun dinonaktifkan
                $this->session->set_flashdata('error', $result['message']);
                redirect('auth/login');
                
            } else {
                // Password salah atau user tidak ditemukan
                $this->session->set_flashdata('error', $result['message']);
                redirect('auth/login');
            }
        }
    }    
    public function register() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        
        $data['title'] = 'Register';
        $this->load->view('auth/register', $data);
    }
    
    public function register_process() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[20]|callback_check_username');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_check_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');
        
        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $data = [
                'username' => $this->input->post('username', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'full_name' => $this->input->post('full_name', TRUE)
            ];
            
            if ($this->user_model->register($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal! Silakan coba lagi.');
                redirect('auth/register');
            }
        }
    }
    
    public function logout() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $this->user_model->log_activity($user_id, 'LOGOUT', 'User logged out');
        }
        
        $this->session->unset_userdata(['user_id', 'username', 'email', 'full_name', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logout berhasil!');
        redirect('auth/login');
    }
    
    public function check_username($username) {
        if ($this->user_model->check_username($username)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_username', 'Username sudah digunakan');
            return FALSE;
        }
    }
    
    public function check_email($email) {
        if ($this->user_model->check_email($email)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_email', 'Email sudah terdaftar');
            return FALSE;
        }
    }
}
