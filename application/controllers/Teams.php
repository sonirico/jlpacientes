<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Teams extends CI_Controller {

    public function __construct() {
        parent::__construct();

        check_login();

        $this->load->model('team');
        $this->load->library('form_validation');
    }

    public function index () {

        $this->load->view('teams/index');

    }

    public function create () {
        $this->load->helper('form', 'url');
        $this->load->library('user_agent');

        $this->load->view('teams/create');
    }

    public function edit ($id) {
        $data = $this->team->get_by_id($id);
        $this->load->library('user_agent');

        $this->load->view('teams/edit', $data);
    }

    public function update ($id) {
        $this->load->helper('custom_url');
        
        if (false === $this->form_validation->run('teams/update'))
        {
            $this->edit($id);
        } 
        else 
        {

            $logo_name = null;

            if (isset($_FILES['logo']))
            {
                $result = $this->handle_logo();

                if ($result['success'])
                {
                    $logo_name = $result['data']['file_name'];
                }
                else
                {
                    $this->session->set_flashdata('status', 'error');
                    $this->session->set_flashdata('message', $result['errors']);

                    redirect('/teams/' . $id . '/edit/');
                }
            }

            if ($this->team->update($id, $logo_name))
            {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('message', 'Equipo editado satisfactoriamente');
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('message', 'Error en la edición del equipo');
            }

            redirect('/teams/' . $id . '/edit/');
        }
    }

    public function store () {

        $this->load->helper('custom_url');
        
        if (false === $this->form_validation->run('teams/store'))
        {
            $this->create();
        } 
        else
        {
            $logo_name = null;

            if ($_FILES['logo']['size'] > 0)
            {
                $result = $this->handle_logo();

                if ($result['success'])
                {
                    $logo_name = $result['data']['file_name'];
                }
                else
                {
                    $this->session->set_flashdata('status', 'error');
                    $this->session->set_flashdata('message', $result['errors']);

                    redirect('/teams/create/');
                }
            }

            if ($this->team->insert($logo_name))
            {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('message', 'Equipo creado satisfactoriamente');

                redirect('/teams/');
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('message', 'Error en la creación del equipo');

                $this->create();
            }

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

    private function handle_logo () {
        $config['upload_path'] = './assets/img/teams/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 768;
        $config['max_height'] = 768;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
            $error = $this->upload->display_errors();

            return [
                'success' => false,
                'errors' => $error
            ];
        }
        else
        {
            $data = $this->upload->data();

            return [
                'success' => true,
                'data' => $data
            ];
        }
    }
}