<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Offsicks extends CI_Controller {

    public function __construct() {
        parent::__construct();

        check_login();

        $this->load->model('offsick');
    }

    public function index ()
    {

        $this->load->view('offsicks/index', [
            'title' => 'Bajas'
        ]);

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

    public function set_current_stage ($player_id)
    {
        if ($this->offsick->set_current_stage($player_id))
        {
            $this->output->set_status_header(200)->_display();
        }
        else
        {
            $this->output->set_status_header(404)->_display();
        }
    }

    public function get_all_offsicks () {

        header('Content-Type: application/json');

        echo json_encode($this->offsick->all_with_players());

    }

    public function for_player ($id)
    {
        $response = $this->offsick->for_player($id) or '{}';

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response))
            ->_display();

        exit;
    }

    public function export ()
    {
        $debug = intval($this->input->get('debug'));

        $this->load->library('pdf');

        $html = $this->load->view('offsicks/export', [], true);

        if ($debug) {
            echo $html;
        } else {
            $this->pdf->generate($html);
        }
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