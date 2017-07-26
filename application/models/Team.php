<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Team extends CI_Model {

    public $id;
    public $name;
    public $logo;
    
    private $table_name = "teams";

    public function get_by_id ($id, $assoc = true)
    {
        $query = $this->db->get_where($this->table_name, [
            'id' => $id
        ]);

        if ($assoc) 
        {
            return $query->row_array();
        }
        else
        {
            return $query->row();
        }
    }

    public function insert ($logo_name = null) {

        $this->name = $this->input->post('name');
        $this->logo = $logo_name;

        return $this->db->insert($this->table_name, $this);
    }

    public function update ($id, $logo_name = null) {

        $this->db->where('id', $id);

        $data = [
            'name' => $this->input->post('name')
        ];

        if ($logo_name)
        {
            $data['logo'] = $logo_name;
        }

        $this->db->update($this->table_name, $data);

        return $this->db->affected_rows();
    }

    public function destroy ($id) {

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);

        return $this->db->affected_rows();
    }

    public function all () {

        $query = $this->db->get($this->table_name);
        
        return $query->result_array();

    }
}