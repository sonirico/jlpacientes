<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Phsession extends CI_Model {

    private $table_name = "ph_sessions";

    public function __construct() {
        parent::__construct();
    }

    public function for_player ($id)
    {
        $this->db->where('player', $id);
        $this->db->order_by('happened_at', 'DESC');

        return $this->db->get($this->table_name)->result_array();
    }


    public function insert ()
    {
        $this->load->helper('custom_date');

        $data = $this->input->post([
            'happened_at', 'player', 'comments'
        ]);
        $data['happened_at'] = datestr_to_unix($data['happened_at']);

        $this->db->insert($this->table_name, $data);

        return $this->db->insert_id();
    }

    public function update ($id)
    {
        $this->load->helper('custom_date');

        $data = $this->input->post([
            'happened_at', 'comments'
        ]);
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

}