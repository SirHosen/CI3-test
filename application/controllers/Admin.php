<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Cek role admin
        $this->load->model('user_model');
        $user = $this->user_model->get_user($this->session->userdata('user_id'));
        if (!$user || $user->role != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman admin!');
            redirect('dashboard');
        }
        
        $this->load->model('admin_model');
    }
    
    public function dashboard() {
        $data['title'] = 'Admin Dashboard';
        $data['stats'] = $this->admin_model->get_dashboard_stats();
        $data['total_users'] = $data['stats']['total_users'];
        $data['active_users'] = $data['stats']['active_users'];
        $data['today_logins'] = $data['stats']['today_logins'];
        
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(5);
        $data['recent_users'] = $this->db->get('users')->result();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    public function users() {
        $data['title'] = 'Manage Users';
        $data['users'] = $this->admin_model->get_all_users();
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($user_id) {
        $data['title'] = 'View User';
        $data['user'] = $this->admin_model->get_user_by_id($user_id);
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User tidak ditemukan!');
            redirect('admin/users');
        }
        
        $data['logs'] = $this->user_model->get_user_logs($user_id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/view_user', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit($user_id) {
        $data['title'] = 'Edit User';
        $data['user'] = $this->admin_model->get_user_by_id($user_id);
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User tidak ditemukan!');
            redirect('admin/users');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,user]');
            
            if ($this->form_validation->run() == TRUE) {
                $update_data = array(
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'role' => $this->input->post('role'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                if ($this->admin_model->update_user($user_id, $update_data)) {
                    $this->session->set_flashdata('success', 'User berhasil diupdate!');
                    redirect('admin/users');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengupdate user!');
                }
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates/footer');
    }
    
    public function delete($user_id) {
        if ($user_id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak dapat menghapus akun sendiri!');
            redirect('admin/users');
        }
        
        if ($this->admin_model->delete_user($user_id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user!');
        }
        redirect('admin/users');
    }
    
    public function logs() {
        $data['title'] = 'System Logs';
        $data['logs'] = $this->admin_model->get_recent_logs(100);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/logs', $data);
        $this->load->view('templates/footer');
    }
    
    public function reports() {
        $data['title'] = 'Reports';
        
        // Statistics
        $data['statistics'] = $this->user_model->get_user_statistics();
        
        // Today's logins
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $this->db->where('action', 'LOGIN');
        $data['today_logins'] = $this->db->count_all_results('user_logs');
        
        // New users this month
        $this->db->where('MONTH(created_at)', date('m'));
        $this->db->where('YEAR(created_at)', date('Y'));
        $data['new_users_month'] = $this->db->count_all_results('users');
        
        // Registration chart data
        $data['registration_chart'] = $this->admin_model->get_user_growth(30);
        
        // Activity chart data
        $data['activity_chart'] = $this->admin_model->get_activity_summary(7);
        
        // Most active users
        $this->db->select('users.*, COUNT(user_logs.id) as login_count, MAX(user_logs.created_at) as last_login');
        $this->db->from('users');
        $this->db->join('user_logs', 'user_logs.user_id = users.id AND user_logs.action = "LOGIN"', 'left');
        $this->db->where('users.is_active', 1);
        $this->db->group_by('users.id');
        $this->db->order_by('login_count', 'DESC');
        $this->db->limit(5);
        $data['active_users'] = $this->db->get()->result();
        
        // Recent activities
        $data['recent_activities'] = $this->admin_model->get_recent_logs(10);
        
        $this->load->view('templates/header', $data);
        $this->load->view('admin/reports', $data);
        $this->load->view('templates/footer');
    }
}
