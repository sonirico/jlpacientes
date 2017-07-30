<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Injury extends CI_Model {

    public $id;
    public $player;
    public $type;
    public $description;
    public $happened_at;
    public $days_off;

    public $table_name = "injuries";

    public function __construct() {
        parent::__construct();
    }

    public function insert ($validated_data = []) {

    }

    public function for_player ($id) {
        $this->db->where('player', $id);
        $this->db->order_by('happened_at', 'DESC');

        $query = $this->db->get($this->table_name);

        return $query->result_array();
    }

    public function all () {

        $query = $this->db->get('offsick', 10);

        return $query->result();

    }
}