<?php defined('BASEPATH') or die('No direct script access allowed');

if (! function_exists('check_login'))
{
    function check_login ()
    {
        $ci =& get_instance();

        $ci->load->helper('auth');

        if (! is_logged_in())
        {
            $ci->load->helper('custom_url');
            redirect('auth/login');
        }
    }
}

if (! function_exists('is_logged_in'))
{
    function is_logged_in ()
    {
        $ci = get_instance();
        $user = current_user();

        if (isset($user))
        {
            return true;
        }

        $ci->load->helper('cookie');

        $token = get_cookie('remember_token');

        if ($token)
        {
            $data = json_decode(base64_decode($token), true);
            $user_hash = hash_hmac(
                'SHA512',
                $data['id'].$data['token'],
                config_item('encryption_key')
            );

            // Signature check
            if ($user_hash === $data['signature'])
            {
                $ci->load->model('user');
                return $ci->user->has_remember_token($data['id'], $data['token']);
            }
        }

        return false;
    }
}

if (! function_exists('current_user'))
{
    function current_user ()
    {
        $ci =& get_instance();

        return $ci->session->userdata('user');
    }
}
