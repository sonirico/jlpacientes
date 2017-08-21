<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Injury extends CI_Model {

    public $id;
    public $player;
    public $type;
    public $description;
    public $happened_at;
    public $days_off;

    private $table_name = "injuries";

    public function __construct()
    {
        parent::__construct();
    }

    public function insert ()
    {
        $this->load->helper('custom_date');

        $data = $this->input->post([
            'happened_at', 'player', 'days_off', 'description', 'type'
        ]);
        $data['happened_at'] = datestr_to_unix($data['happened_at']);

        $this->db->insert($this->table_name, $data);

        $injury_id = $this->db->insert_id();

        if ($injury_id)
        {
            $player_id = $this->input->post('player');

            // CI BUG??
            $this->load->model('player', 'p');

            if (! $this->p->is_offsick($player_id))
            {
                if ($this->input->post('has_offsick'))
                {
                    $this->p->offsick($player_id);
                }

                $this->load->model('offsick');

                if ($this->offsick->insert($injury_id, $player_id))
                {
                    return 1;
                }
            }

            return 2;
        }

        return 0;
    }

    public function update ($id)
    {
        $this->load->helper('custom_date');

        $data = $this->input->post([
            'happened_at', 'player', 'days_off', 'description', 'type'
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