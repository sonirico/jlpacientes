<?php defined('BASEPATH') or exit('No direct script access is allowed');

class User extends CI_Model {

    public $id;
    public $email;
    public $username;
    public $password;
    public $remember_token;

    private $table_name = "users";

    public function __construct()
    {
        parent::__construct();
    }

    public function insert ()
    {
        $this->load->helper('custom_date');

        $data = $this->input->post();
        $data['happened_at'] = datestr_to_unix($data['happened_at']);

        $this->db->insert($this->table_name, $data);

        return $this->db->insert_id();
    }

    public function update ($id)
    {
        $this->load->helper('custom_date');

        $data = $this->input->post();
        $data['happened_at'] = datestr_to_unix($data['happened_at']);

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);

        return $this->db->affected_rows();
    }

    public function destroy ($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);

        return $this->db->affected_rows();
    }

    public function for_player ($id)
    {
        $this->db->where('player', $id);

        $query = $this->db->get($this->table_name);


        return $query->result_array();
    }

    public function all ()
    {

        $query = $this->db->get('offsick', 10);

        return $query->result();

    }

    public function login () {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('username', $username);
        $this->db->or_where('email', $username);

        $query = $this->db->get($this->table_name);

        $user = $query->row_array();

        if ($user && password_verify($password, $user['password']))
            return $user;

        return false;
    }

    public function has_password ($user_id, $password)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get($this->table_name);

        $user = $query->row_array();

        if ($user)
        {
            return password_verify($password, $user['password']);
        }

        return false;
    }

    public function change_password ($user_id, $password)
    {
        $this->db->where('id', $user_id);
        $this->db->update($this->table_name, [
            'password' => password_hash($password, config_item('algo'))
        ]);

        return $this->db->affected_rows() > 0;
    }

    public function has_remember_token ($id, $token)
    {
        $this->db->where('id', $id);
        $this->db->where('remember_token', $token);

        $query = $this->db->get($this->table_name);

        return $query->row_array();
    }

    public function unset_remember_token ($id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, ['remember_token' => null]);

        return $this->db->affected_rows() > 0;
    }

    public function set_remember_token ()
    {
        $this->load->helper('auth');

        $user = current_user();
        $token = $this->create_remember_token();

        $this->db->where('id', $user['id']);
        $this->db->update($this->table_name, [
            'remember_token' => $token
        ]);

        if ($this->db->affected_rows() > 0)
        {
            $this->load->helper('cookie');

            $value = json_encode([
                'id' => $user['id'],
                'token' => $token,
                'signature' => hash_hmac(
                    'SHA512',
                    $user['id'] . $token,
                    config_item('encryption_key')
                )
            ]);

            set_cookie(
                'remember_token',
                base64_encode($value),
                60 * 60 * 24 * 365 * 10
            );
        }
        else
        {
            return false;
        }
    }

    private function create_remember_token ()
    {
        $token = base64_encode(
            time() .
            config_item('encryption_key') .
            $this->create_random_string(32)
        );

        return substr($token,0, 32);
    }

    private function create_random_string ($length)
    {
        $r = "";

        for ($i = 0; $i < $length; $i++)
            $r .= chr(rand(65, 122));

        return $r;
    }
}