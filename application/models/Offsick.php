<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Offsick extends CI_Model {

    private $table_name = "offsicks";

    public function __construct() {
        parent::__construct();
    }

    public function insert ($injury_id, $player_id)
    {
        $this->db->insert($this->table_name, [
            'player' => $player_id,
            'injury' => $injury_id,
            'current_stage' => intval($this->input->post('current_stage'))
        ]);

        if ($this->input->post('has_offsick'))
        {
            $this->load->model('player');
            $this->player->offsick($player_id);
        }

        return $this->db->affected_rows();
    }

    public function insert_or_update ($id)
    {
        $current_stage = intval($this->input->post('current_stage'));

        $query = $this->db->where([
            'player' => $id,
            'ended_at' => null
        ])->get($this->table_name);

        if ($query->num_rows() > 0)
        {
            die(var_dump($query->row_array()));
        }
        else
        {
            $this->db->insert($this->table_name, [
                'player' => $id,
                'stages' => json_encode([
                    $current_stage => time()
                ])
            ]);
        }

        return 1;
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

    public function all () {

        $query = $this->db->get('offsick', 10);

        return $query->result();

    }
}