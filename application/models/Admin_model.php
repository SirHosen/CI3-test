<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_dashboard_stats() {
        $stats = array();
        
        // Total users
        $stats['total_users'] = $this->db->count_all('users');
        
        // Active users
        $this->db->where('is_active', 1);
        $stats['active_users'] = $this->db->count_all_results('users');
        
        // Today's registrations
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $stats['today_registrations'] = $this->db->count_all_results('users');
        
        // Today's logins
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $this->db->where('action', 'LOGIN');
        $stats['today_logins'] = $this->db->count_all_results('user_logs');
        
        return $stats;
    }
    
    public function get_user_growth($days = 30) {
        $this->db->select('DATE(created_at) as date, COUNT(*) as count');
        $this->db->from('users');
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-'.$days.' days')));
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_activity_summary($days = 7) {
        $this->db->select('action, COUNT(*) as count');
        $this->db->from('user_logs');
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-'.$days.' days')));
        $this->db->group_by('action');
        $this->db->order_by('count', 'DESC');
        return $this->db->get()->result();
    }
    
    public function toggle_user_status($user_id) {
        $user = $this->db->get_where('users', array('id' => $user_id))->row();
        if ($user) {
            $new_status = $user->is_active == 1 ? 0 : 1;
            $this->db->where('id', $user_id);
            return $this->db->update('users', array('is_active' => $new_status));
        }
        return false;
    }
    
    public function delete_user($user_id) {
        return $this->db->delete('users', array('id' => $user_id));
    }
    
    public function update_user($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }
    
    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', array('id' => $user_id))->row();
    }
    
    public function get_all_users() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('users')->result();
    }
    
    public function get_recent_logs($limit = 100) {
        $this->db->select('user_logs.*, users.username');
        $this->db->from('user_logs');
        $this->db->join('users', 'users.id = user_logs.user_id');
        $this->db->order_by('user_logs.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}
