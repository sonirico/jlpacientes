<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Nutrition extends CI_Model {

    private $table_name = "nutrition";

    public function __construct()
    {
        parent::__construct();
    }

    public function insert ()
    {
        $data = $this->input->post();

        $this->db->insert($this->table_name, $data);

        return $this->db->insert_id();
    }

    public function update ($id)
    {
        $data = $this->input->post();

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
}