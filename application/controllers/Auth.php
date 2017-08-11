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
            $this->load->helper('cookie');

            $user = current_user();

            delete_cookie('remember_token');

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

    public function password_reset_pre ()
    {
        $this->load->helper('form');
        $this->load->library('user_agent');

        $this->load->view('auth/password_reset', [
            'back_uri' => '/'
        ]);
    }

    public function password_reset_post ()
    {
        $this->load->library('form_validation');

        if (false === $this->form_validation->run('password_reset'))
        {
            $this->password_reset_pre();
        }
        else
        {
            $user_id = current_user()['id'];
            $password = $this->input->post('new_password');

            if ($this->user->change_password($user_id, $password))
            {
                $this->session->set_userdata(['password_reset' => true]);

                $this->logout();
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('message', 'Error. No se ha cambiado la contraseña.');

                $this->password_reset_pre();
            }
        }
    }

    public function check_current_password () {
        $password = $this->input->post('current_password');
        $user_id = current_user()['id'];

        if ($this->user->has_password($user_id, $password))
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('check_current_password', 'Usuario y/o contraseña incorrectos');
            return false;
        }
    }
}