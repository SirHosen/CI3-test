<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    private $table = 'users';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function register($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->db->insert($this->table, $data);
    }
    
    public function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
        $user = $this->db->get($this->table)->row();
        
        if ($user) {
            // Cek apakah akun aktif
            if ($user->is_active == 0) {
                return array('status' => 'inactive', 'message' => 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');
            }
            
            // Cek password
            if (password_verify($password, $user->password)) {
                // Update last login
                $this->db->where('id', $user->id);
                $this->db->update($this->table, array('updated_at' => date('Y-m-d H:i:s')));
                
                // Log activity
                $this->log_activity($user->id, 'LOGIN', 'User logged in');
                
                return array('status' => 'success', 'user' => $user);
            } else {
                return array('status' => 'error', 'message' => 'Username atau password salah!');
            }
        }
        
        return array('status' => 'error', 'message' => 'Username atau password salah!');
    }
    
    // METHOD YANG HILANG - CHECK USERNAME
    public function check_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        return $query->num_rows() == 0; // Return TRUE jika username belum ada
    }
    
    // METHOD YANG HILANG - CHECK EMAIL
    public function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() == 0; // Return TRUE jika email belum ada
    }
    
    // CHECK USER STATUS (ACTIVE/INACTIVE)
    public function check_user_status($user_id) {
        $this->db->select('is_active');
        $this->db->where('id', $user_id);
        $user = $this->db->get($this->table)->row();
        
        if ($user) {
            return $user->is_active == 1;
        }
        return false;
    }
    
    public function get_user($id) {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }
    
    public function get_active_users() {
        // Cek apakah view exists
        $view_exists = $this->db->query("SHOW TABLES LIKE 'active_users_view'")->num_rows() > 0;
        
        if ($view_exists) {
            return $this->db->get('active_users_view')->result();
        } else {
            // Fallback jika view tidak ada
            $this->db->select('users.*, COUNT(user_logs.id) as login_count');
            $this->db->from('users');
            $this->db->join('user_logs', 'user_logs.user_id = users.id AND user_logs.action = "LOGIN"', 'left');
            $this->db->where('users.is_active', 1);
            $this->db->group_by('users.id');
            return $this->db->get()->result();
        }
    }
    
    public function get_user_statistics() {
        // Cek apakah view exists
        $view_exists = $this->db->query("SHOW TABLES LIKE 'user_statistics_view'")->num_rows() > 0;
        
        if ($view_exists) {
            return $this->db->get('user_statistics_view')->row();
        } else {
            // Fallback jika view tidak ada
            $stats = new stdClass();
            $stats->total_users = $this->db->count_all('users');
            
            $this->db->where('is_active', 1);
            $stats->active_users = $this->db->count_all_results('users');
            
            $this->db->where('is_active', 0);
            $stats->inactive_users = $this->db->count_all_results('users');
            
            $this->db->select('COUNT(DISTINCT DATE(created_at)) as days');
            $result = $this->db->get('users')->row();
            $stats->registration_days = $result->days;
            
            return $stats;
        }
    }
    
    public function log_activity($user_id, $action, $description) {
        $data = array(
            'user_id' => $user_id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent()
        );
        return $this->db->insert('user_logs', $data);
    }
    
    public function get_user_logs($user_id = null) {
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(10); // Limit to 10 recent logs
        return $this->db->get('user_logs')->result();
    }
    
    // UPDATE USER PROFILE
    public function update_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update($this->table, $data);
    }
    
    // UPDATE PASSWORD
    public function update_password($user_id, $new_password) {
        $data = array(
            'password' => password_hash($new_password, PASSWORD_BCRYPT),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $user_id);
        return $this->db->update($this->table, $data);
    }
    
    // GET ALL USERS (untuk admin)
    public function get_all_users() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    // SEARCH USERS
    public function search_users($keyword) {
        $this->db->like('username', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('full_name', $keyword);
        return $this->db->get($this->table)->result();
    }
    
    // COUNT LOGIN ATTEMPTS (untuk security)
    public function count_login_attempts($username, $minutes = 30) {
        $time_ago = date('Y-m-d H:i:s', strtotime('-'.$minutes.' minutes'));
        
        $this->db->select('users.id');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->or_where('email', $username);
        $user = $this->db->get()->row();
        
        if ($user) {
            $this->db->where('user_id', $user->id);
            $this->db->where('action', 'LOGIN_FAILED');
            $this->db->where('created_at >', $time_ago);
            return $this->db->count_all_results('user_logs');
        }
        
        return 0;
    }
}
