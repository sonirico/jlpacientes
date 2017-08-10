<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user');
    }

    public function login_pre ()
    {
        $this->load->helper('auth', 'custom_url');

        if (is_logged_in())
        {
            redirect('/');
        }
        else
        {
            $this->load->helper('form');
            $this->load->view('auth/login');
        }
    }

    public function login_post () {
        $this->load->library('form_validation');
        $this->load->helper('custom_url');

        if (false === $this->form_validation->run('login'))
        {
            $this->login_pre();
        }
        else
        {
            if (boolval($this->input->post('remember-me')))
            {
                $this->user->set_remember_token();
            }

            redirect('/');
        }
    }

    public function logout () {
        $this->load->helper('custom_url');

        if (is_logged_in())
        {
            $user = current_user();

            $this->user->unset_remember_token($user['id']);

            $this->session->unset_userdata('user');
        }

        redirect('/');
    }

    public function check_login () {
        $user = $this->user->login();

        if ($user)
        {
            $this->session->set_userdata(['user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ]]);

            return true;
        }
        else
        {
            $this->form_validation->set_message('check_login', 'Usuario y/o contraseña incorrectos');
            return false;
        }
    }
}