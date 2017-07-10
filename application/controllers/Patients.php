<?php defined('BASEPATH') or exit('No direct script access is allowed');

class Patients extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('patient');
    }

    public function index () {

        

        $data = [
            // 'patients' => $this->patient->all()
        ];

        $this->load->view('patients/index', $data);

    }

    public function create_patient () {

        $this->load->helper('input');
        
        if ($this->patient->insert()) {
            echo 'sí';
        } else {
            echo 'no';
        }
        

    }

    public function get_all_patients () {

        echo json_encode($this->patient->all());

    }
}