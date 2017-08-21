<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Injuries extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        check_login();

        $this->load->model('injury');
        $this->load->library('form_validation');
    }

    public function destroy ($id)
    {
        $status = $this->injury->destroy($id) > 0 ? 200 : 404;

        $this->output->set_status_header($status)->_display();
    }

    public function update ($id)
    {
        if (true === $this->form_validation->run('injuries/update'))
        {
            if ($this->injury->update($id) > 0) {

                $this->output->set_status_header(200)->_display();

                exit;

            }
        }

        $this->output->set_status_header(404)->_display();
    }

    public function store ()
    {
        if (true === $this->form_validation->run('injuries/store'))
        {
            switch ($this->injury->insert())
            {
                case 0:
                    $this->output->set_status_header(404)->_display();
                    exit;
                case 1:
                    $this->output->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode([
                            'status' => 'added_with_offsick'
                        ]))->_display();
                    exit;
                case 2: // player already offsick
                    $this->output->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode([
                            'status' => 'added_without_offsick'
                        ]))
                        ->_display();
                    exit;
            }
        }

        $this->output->set_status_header(404)->_display();
    }

    public function happened_at_check ($str) {
        $date = date_create_from_format('d/m/Y', $str);
        $date_valid = $date && $date->format('d/m/Y') === $str;

        if ($date_valid)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('happened_at',
                'El campo {field} no cumple con el formato dd/mm/yyyy');
            return false;
        }
    }
}