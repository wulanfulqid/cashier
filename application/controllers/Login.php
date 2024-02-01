<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MSudi'); // Load your user model
    }

    public function index() {
        $this->load->library('form_validation');
    
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show login form
            $this->load->view('VLogin');
        } else {
            // Validation passed, check login credentials
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            // Perform your authentication logic here (e.g., check against a database)
            $authentication_passed = $this->MSudi->check_credentials($username, $password);
    
            if ($authentication_passed) {
                $this->load->library('session');
                $this->session->set_userdata('Login', 'Aktif');
                redirect(site_url('Welcome'));
            } else {
                // Authentication failed, show login form with an error message
                $data['error'] = 'Invalid username or password';
                $this->load->view('VLogin', $data);
            }
        }
    }
}
