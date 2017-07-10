<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Migrate extends CI_Controller {

    public function index ($version) 
    {

        $this->load->library('migration');

        if ($this->migration->version($version) === FALSE)
        {
            show_error($this->migration->error_string());
        }

    }
}