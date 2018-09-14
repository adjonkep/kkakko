<?php
class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        $this->load->database();

        // Load database
        $this->load->model('LoginModel');
    }

    // Show registration page
    public function user_registration_show()
    {
        $this->load->view('users/register');
    }

    // Register user
    public function register()
    {
        //$data['title'] = 'Sign Up';
        //$this->form_validation->set_rules('name', 'Name', 'required');
        //$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        //$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
        if ($this->form_validation->run() === false) {
            $this->load->view('users/register');
        } else {
            // Encrypt password
            $enc_password = md5($this->input->post('password'));
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $enc_password,
            );
            $result = $this->LoginModel->registration_insert($data);
            if ($result == true) {
                $_SESSION["logged_in"] == true;
                $_SESSION["sendInfo"] == $_POST['infoData'];
                $this->load->view('confirm', $data);
            } else {
                $this->load->view('confirm', $data);
            }
            // Set message
            //$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            //redirect('index.php/send');
        }
    }
    // Log in user
    public function login()
    {
        $data['title'] = 'Sign In';
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === false) {
            $this->load->view('users/login', $data);
        } else {

            // Get username
            //$username = $this->input->post('username');
            //Get email
            $email = $this->input->post('email');
            // Get and encrypt the password
            $password = md5($this->input->post('password'));
            // Login user
            $user_id = $this->LoginModel->login($user_data);
            if ($user_id) {
                // Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true,
                );
                $this->session->set_userdata($user_data);
                // Set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('send');
            } else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('users/login');
            }
        }
    }
    // Log user out
    public function logout()
    {
        // Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        // Set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('users/login');
    }
    // Check if username exists
    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
        if ($this->LoginModel->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }
    // To do: mailchimp integrations
    public function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
        if ($this->LoginModel->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }
}
