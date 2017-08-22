<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Offsick extends CI_Model {

    private $table_name = "offsicks";

    public function __construct() {
        parent::__construct();
    }

    public function for_player ($id)
    {
        $this->db->where('player', $id);
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get($this->table_name)->result_array();
    }

    public function insert ($injury_id, $player_id)
    {
        $this->db->insert($this->table_name, [
            'player' => $player_id,
            'injury' => $injury_id,
            'current_stage' => intval($this->input->post('current_stage'))
        ]);

        return $this->db->affected_rows();
    }


    public function set_current_stage ($player_id)
    {
        $this->db->where('player', $player_id);
        $this->db->where('ended_at', null);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(1);

        $query = $this->db->get($this->table_name);

        $result = $query->row_array();

        if ($result)
        {
            $this->db->where('id', $result['id']);
            $this->db->update($this->table_name, [
                'current_stage' => intval($this->input->post('stage'))
            ]);

            return $this->db->affected_rows();
        }

        return 0;
    }

    public function all_with_players () {

        $this->db->select(
            'offsicks.*, ' .
            'CONCAT(players.name, " ", players.surname) as player_full_name, '.
            'players.id as player_id'
        );

        $this->db->from($this->table_name);
        $this->db->join('players', 'players.id = offsicks.player');
        $this->db->order_by('offsicks.created_at', 'desc');
        $this->db->order_by('players.name', 'asc');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function all ()
    {

        $query = $this->db->get($this->table_name);

        return $query->result_array();

    }

    public function get_injury ($offsick_id)
    {
        $this->db->select('injuries.*');
        $this->db->from('offsicks');
        $this->db->join('injuries', 'offsicks.injury = injuries.id');
        $this->db->where('offsicks.id', $offsick_id);

        return $this->db->get()->row_array();
    }
}