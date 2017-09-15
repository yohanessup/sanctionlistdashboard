<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

    public function index()
    {
        $this->load->model('Employee_model');

        $employee = $this->Employee_model->get_data();

        $this->load->view('employee_data', array('data'=>$employee));
    }
}
