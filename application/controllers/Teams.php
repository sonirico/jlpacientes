<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Teams extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('team');
        $this->load->library('form_validation');
    }

    public function index () {

        $this->load->view('teams/index');

    }

    public function create () {
        $this->load->helper('form', 'url');

        $this->load->view('teams/create');
    }

    public function edit ($id) {
        $data = $this->team->get_by_id($id);

        $this->load->view('teams/edit', $data);
    }

    public function update ($id) {
        $this->load->helper('custom_url');
        
        if (false === $this->form_validation->run('teams/update'))
        {
            $this->load->view('teams/edit');
        } 
        else 
        {
            if ($this->team->update($id))
            {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('message', 'Equipo editado satisfactoriamente');
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('status', 'Error en la edición del equipo');
            }

            redirect('/teams/' . $id . '/edit/');
        }
    }

    public function store () {
        $this->load->helper('custom_url');
        
        if (false === $this->form_validation->run('teams/store'))
        {
            $this->load->view('teams/create');
        } 
        else 
        {
            if ($this->team->insert())
            {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('message', 'Equipo creado satisfactoriamente');
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('status', 'Error en la creación del equipo');
            }

            redirect('/teams/');
        }
    }

    public function destroy ($id) {
        if ($this->team->destroy($id))
        {
            $this->output->set_status_header(200);
        }
        else 
        {
            $this->output->set_status_header(404);
        }
    }

    public function all () {

        header('Content-Type: application/json');

        echo json_encode($this->team->all());

    }
}