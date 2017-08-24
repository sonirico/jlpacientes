<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Phsessions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        check_login();

        $this->load->model('phsession');
        $this->load->library('form_validation');
    }

    public function index ($id) {
        $this->output->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode(
                $this->phsession->for_player($id)
            ))->_display();

        exit;
    }

    public function destroy ($id)
    {
        $status = $this->phsession->destroy($id) > 0 ? 200 : 404;

        $this->output->set_status_header($status)->_display();
    }

    public function update ($id)
    {
        if (true === $this->form_validation->run('phsessions/create_or_update'))
        {
            if ($this->phsession->update($id) > 0) {

                $this->output->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode([
                        'status' => 'ok'
                    ]))->_display();

                exit;

            }
        }

        $this->output->set_status_header(404)->_display();
    }

    public function store ()
    {
        if (true === $this->form_validation->run('phsessions/create_or_update'))
        {
            if ($this->phsession->insert() > 0)
            {
                $this->output->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode([
                        'status' => 'ok'
                    ]))->_display();
                exit;
            }
            else {
                $this->output->set_status_header(404)->_display();
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