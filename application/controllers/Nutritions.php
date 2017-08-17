<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Nutritions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        check_login();

        $this->load->model('nutrition');
        $this->load->library('form_validation');
    }

    public function destroy ($id)
    {
        $status = $this->nutrition->destroy($id) > 0 ? 200 : 404;

        $this->output->set_status_header($status)->_display();
    }

    public function update ($id)
    {
        if (true === $this->form_validation->run('nutrition/update_store'))
        {
            if ($this->nutrition->update($id) > 0) {

                $this->output->set_status_header(200)->_display();

                exit;
            }
        }

        echo validation_errors();

        $this->output->set_status_header(404)->_display();
    }

    public function store ()
    {
        if (true === $this->form_validation->run('nutrition/update_store'))
        {
            if ($this->nutrition->insert() > 0) {

                $this->output->set_status_header(200)->_display();

                exit;
            }
        }

        echo validation_errors();

        $this->output->set_status_header(404)->_display();
    }

    public function for_player ($id) {

        $response = $this->nutrition->for_player($id) or [];

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response))
            ->_display();

        exit;

    }
}