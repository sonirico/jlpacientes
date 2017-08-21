<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Player extends CI_Model {

    public $id;
    public $name;
    public $surname;
    public $nif;
    public $birthday;
    public $address;
    public $contact;

    public $id_position;
    public $id_team;

    private $table_name = "players";

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

    public function insert () {

        $this->load->helper('custom_date');

        $data = $this->input->post();
        $data['birthday'] = datestr_to_unix($data['birthday']);

        return $this->db->insert($this->table_name, $data);
    }

    public function update ($id) {

        $this->load->helper('custom_date');

        $data = $this->input->post();
        $data['birthday'] = datestr_to_unix($data['birthday']);

        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);

        return $this->db->affected_rows();
    }

    public function destroy ($id) {

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);

        return $this->db->affected_rows();
    }

    public function offsick ($id) {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, [
            'offsick' => true
        ]);

        return $this->db->affected_rows();
    }

    public function upsick ($id) {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, [
            'offsick' => false
        ]);


        $this->db->set('ended_at', 'NOW()', false);
        $this->db->where('player', $id);
        $this->db->where('ended_at', null);
        $this->db->update('offsicks');

        return $this->db->affected_rows();
    }

    public function all () {

        $query = $this->db->get($this->table_name);

        return $query->result_array();

    }

    public function injuries ($id) {
        $this->db->where('player', $id);

        $query = $this->db->get('injuries');


        return $query->result_array();
    }

    public function nutrition ($id) {
        $this->db->where('player', $id);
        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get('nutrition');

        return $query->result_array();
    }

    public function all_with_teams () {
        $this->db->select('players.*, teams.name as team_name, offsicks.current_stage as current_stage');
        $this->db->from('players');
        $this->db->join('teams', 'teams.id = players.team', 'left');
        $this->db->join('offsicks', 'offsicks.player = players.id', 'left');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function one_with_team ($id) {
        $this->db->select('players.*, teams.name as team_name');
        $this->db->from('players');
        $this->db->join('teams', 'teams.id = players.team', 'left');
        $this->db->where('players.id', $id);

        $query = $this->db->get();

        return $query->row_array();
    }

    public function one_with_offsicks ($id) {

    }

    public function is_offsick ($player_id)
    {
        $this->db->where('id', $player_id);
        $this->db->where('offsick >', 0);

        if ($this->db->get($this->table_name)->num_rows() > 0)
        {
            return true;
        }
        else
        {
            $this->db->where('player', $player_id);
            $this->db->where('ended_at', null);

            return $this->db->get('offsicks')->num_rows() > 0;
        }
    }
}