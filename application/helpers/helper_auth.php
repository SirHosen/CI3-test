<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        $CI =& get_instance();
        return $CI->session->userdata('logged_in') ? true : false;
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        $CI =& get_instance();
        if (!is_logged_in()) {
            return false;
        }
        
        $CI->load->model('user_model');
        $user = $CI->user_model->get_user($CI->session->userdata('user_id'));
        return ($user && $user->role == 'admin');
    }
}

if (!function_exists('get_current_user')) {
    function get_current_user() {
        $CI =& get_instance();
        if (is_logged_in()) {
            return (object) array(
                'id' => $CI->session->userdata('user_id'),
                'username' => $CI->session->userdata('username'),
                'email' => $CI->session->userdata('email'),
                'full_name' => $CI->session->userdata('full_name')
            );
        }
        return null;
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission) {
        // Implementasi permission checking
        return true;
    }
}
