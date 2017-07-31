<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Players extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('player');
        $this->load->library('form_validation');
    }

    public function index () {

        $this->load->view('players/index');

    }

    public function create () {
        $this->load->helper('form', 'url');
        $this->load->model('team');
        $this->load->library('user_agent');
        
        $this->load->view('players/create', [
            'teams' => $this->team->all()
        ]);
    }

    public function edit ($id) {
        $player = $this->player->get_by_id($id);

        $this->load->model('team');
        $this->load->library('user_agent');

        $this->load->view('players/edit',
            array_merge(
                ['teams' => $this->team->all()],
                $player
            )
        );
    }

    public function show ($id) {
        $player = $this->player->one_with_team($id);

        $this->load->view('players/show', $player);
    }

    public function update ($id) {
        $this->load->helper('custom_url');
        
        if (false === $this->form_validation->run('players/update'))
        {
            $this->edit($id);
        } 
        else 
        {
            if ($this->player->update($id))
            {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('message', 'Jugador editado satisfactoriamente');
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('status', 'Error en la edición del jugador');
            }

            redirect('/players/' . $id . '/edit/');
        }
    }

    public function store () {
        $this->load->helper('custom_url');
        
        if (false === $this->form_validation->run('players/store'))
        {
            $this->create();
        } 
        else 
        {
            if ($this->player->insert())
            {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('message', 'Jugador creado satisfactoriamente');
            }
            else
            {
                $this->session->set_flashdata('status', 'error');
                $this->session->set_flashdata('status', 'Error en la creación del jugador');
            }

            redirect('/players/');
        }
    }

    public function destroy ($id) {
        if ($this->player->destroy($id))
        {
            $this->output->set_status_header(200);
        }
        else 
        {
            $this->output->set_status_header(404);
        }
    }

    public function all () 
    {
        $response = $this->player->all_with_teams();
        
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response))
            ->_display();
        exit;
    }

    public function offsick ($id)
    {
        $response = $this->player->offsick($id);

        if (intval($response) > 0) {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        }
        else
        {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        }


        exit;
    }

    public function upsick ($id)
    {
        $response = $this->player->upsick($id);

        if (intval($response) > 0) {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        }
        else
        {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        }


        exit;
    }

    public function injuries ($id)
    {
        $this->load->model('injury');

        header('Content-Type: application/json');

        echo json_encode($this->injury->for_player($id));
    }


    public function birthday_check ($str) {
        $date = date_create_from_format('d/m/Y', $str);
        $date_valid = $date && $date->format('d/m/Y') === $str;

        if ($date_valid)
        {
            return true;
        }
        else 
        {
            $this->form_validation->set_message('birthday_check', 
                'El campo {field} no cumple con el formato dd/mm/yyyy');
            return false;
        }
    }

    public function team_check ($team_id) {
        if (intval($team_id) < 1) 
        {
            $this->form_validation->set_message('team_check', 'El campo "%s" es obligatorio');
            return false;
        }

        $this->load->model('team');

        $valid_team = boolval($this->team->get_by_id(intval($team_id)));

        if ($valid_team) 
        {
            return true;
        }
        else 
        {
            $this->form_validation->set_message('team_check', 
                'El equipo especificado no existe');
            return false;
        }
    }
}