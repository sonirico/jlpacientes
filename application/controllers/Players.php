<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Players extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('player');
    }

    public function index () {

        $this->load->view('players/index', [
            'players' => $this->player->all()
        ]);

    }

    public function create () {

        $this->load->view('players/create');

    }

    public function store () {
        

    }
}