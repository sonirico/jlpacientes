<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Offsicks extends CI_Controller {

    public function __construct() {
        parent::__construct();

        check_login();

        $this->load->model('offsick');
    }

    public function index () {

        $this->load->view('offsicks/index', $this->get_initial_data());

    }

    public function create () {

        $this->load->view('offsicks/create', $this->get_initial_data());

    }

    public function store () {
        
        if ($this->offsick->insert($_POST)) {
            echo 'sí'; 
        } else {
            echo 'no';
        }
        

    }

    public function get_all_offsicks () {

        header('Content-Type: application/json');

        echo json_encode($this->offsick->all());

    }

    private function get_initial_data () {
        return [
            'stages' => $this->config->item('stages'),
            'teams' => $this->config->item('teams'),
            'injuries' => $this->config->item('injuries'),
            'positions' => $this->config->item('positions')
        ];
    }
}