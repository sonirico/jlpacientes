<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Offsick extends CI_Model {

    public $id;
    public $name;
    public $surname;
    public $diagnosis;
    public $position;
    public $stage;
    public $team;
    public $injury;
    public $date_off;
    public $days_off;

    public $table_name = "offsick";

    public function __construct() {
        parent::__construct();
    }

    public function insert ($validated_data = []) {

        die(var_dump($validated_data));

        // $this->name = $this->input->('name');
        // $this->surname = $this->input('surname');
        // $this->diagnosis = $this->input('diagnosis');
        // $this->position = $this->input('position');
        // $this->stage = $this->input('stage');
        // $this->stage = $this->input('team');
        // $this->stage = $this->input('injury');
        // $this->stage = $this->input('date_off');
        // $this->stage = $this->input('days_off');

        $query = $this->db->insert($this->table_name, $validated_data);

        die($query);
    }

    public function all () {

        $query = $this->db->get('offsick', 10);
        
        return $query->result();

    }
}