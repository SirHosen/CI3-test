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
        
        if ($user && password_verify($password, $user->password)) {
            // Update last login
            $this->db->where('id', $user->id);
            $this->db->update($this->table, ['updated_at' => date('Y-m-d H:i:s')]);
            
            // Log activity
            $this->log_activity($user->id, 'LOGIN', 'User logged in');
            
            return $user;
        }
        return false;
    }
    
    public function check_username($username) {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        return $query->num_rows() == 0;
    }
    
    public function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() == 0;
    }
    
    public function get_user($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    
    public function get_active_users() {
        return $this->db->get('active_users_view')->result();
    }
    
    public function get_user_statistics() {
        return $this->db->get('user_statistics_view')->row();
    }
    
    public function log_activity($user_id, $action, $description) {
        $data = [
            'user_id' => $user_id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent()
        ];
        $this->db->insert('user_logs', $data);
    }
    
    public function get_user_logs($user_id = null) {
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('user_logs')->result();
    }
}
