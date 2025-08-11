<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Load model
        $this->load->model('user_model');
        
        // Cek status akun
        $user_id = $this->session->userdata('user_id');
        if (!$this->user_model->check_user_status($user_id)) {
            $this->session->unset_userdata(array('user_id', 'username', 'email', 'full_name', 'role', 'logged_in'));
            $this->session->sess_destroy();
            $this->session->set_flashdata('error', 'Akun Anda telah dinonaktifkan oleh administrator.');
            redirect('auth/login');
        }
    }
    
    public function profile() {
        $data['title'] = 'Profile';
        $data['user'] = $this->user_model->get_user($this->session->userdata('user_id'));
        $data['logs'] = $this->user_model->get_user_logs($this->session->userdata('user_id'));
        
        $this->load->view('templates/header', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit_profile() {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->user_model->get_user($this->session->userdata('user_id'));
        
        $this->load->view('templates/header', $data);
        $this->load->view('user/edit_profile', $data);
        $this->load->view('templates/footer');
    }
    
		public function update_profile() {
		$user_id = $this->session->userdata('user_id');
		
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		
		if ($this->form_validation->run() == FALSE) {
			$this->edit_profile();
		} else {
			// Cek apakah email berubah dan sudah digunakan user lain
			$new_email = $this->input->post('email', TRUE);
			$current_user = $this->user_model->get_user($user_id);
			
			if ($new_email != $current_user->email) {
				// Cek apakah email sudah digunakan
				$this->db->where('email', $new_email);
				$this->db->where('id !=', $user_id);
				$email_exists = $this->db->get('users')->num_rows() > 0;
				
				if ($email_exists) {
					$this->session->set_flashdata('error', 'Email sudah digunakan user lain!');
					redirect('user/edit_profile');
					return;
				}
			}
			
			$data = array(
				'full_name' => $this->input->post('full_name', TRUE),
				'email' => $new_email,
				'updated_at' => date('Y-m-d H:i:s')
			);
			
			$this->db->where('id', $user_id);
			if ($this->db->update('users', $data)) {
				// Update session
				$this->session->set_userdata(array(
					'email' => $data['email'],
					'full_name' => $data['full_name']
				));
				
				// Log activity
				$this->user_model->log_activity($user_id, 'UPDATE_PROFILE', 'User updated profile');
				
				$this->session->set_flashdata('success', 'Profile berhasil diupdate!');
				redirect('user/profile');
			} else {
				$this->session->set_flashdata('error', 'Gagal mengupdate profile!');
				redirect('user/edit_profile');
			}
		}
	}

    
    public function change_password() {
        if ($this->input->post()) {
            $user_id = $this->session->userdata('user_id');
            
            $this->form_validation->set_rules('current_password', 'Password Lama', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');
            
            if ($this->form_validation->run() == TRUE) {
                $user = $this->user_model->get_user($user_id);
                $current_password = $this->input->post('current_password');
                
                if (password_verify($current_password, $user->password)) {
                    $new_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
                    
                    $this->db->where('id', $user_id);
                    if ($this->db->update('users', array('password' => $new_password))) {
                        $this->user_model->log_activity($user_id, 'CHANGE_PASSWORD', 'User changed password');
                        $this->session->set_flashdata('success', 'Password berhasil diubah!');
                        redirect('user/profile');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengubah password!');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password lama tidak sesuai!');
                }
                redirect('user/change_password');
            }
        }
        
        $data['title'] = 'Ubah Password';
        $this->load->view('templates/header', $data);
        $this->load->view('user/change_password', $data);
        $this->load->view('templates/footer');
    }
}
