<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Patient extends CI_Model {

    public $id;
    public $name;
    public $surname;
    public $diagnosis;
    public $position;
    public $stage;

    public function __construct() {
        parent::__construct();
    }

    public function insert () {

        $this->name = $this->input('name');
        $this->surname = $this->input('surname');
        $this->diagnosis = $this->input('diagnosis');
        $this->position = $this->input('position');
        $this->stage = $this->input('stage');

        $query = $this->db->insert('patient', $this);

        die($query);
    }

    public function all () {

        $query = $this->db->get('patient', 10);
        
        return $query->result();

    }
}