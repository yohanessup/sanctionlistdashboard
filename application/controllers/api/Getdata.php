<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/22/2017
 * Time: 10:41 AM
 */


require APPPATH . 'libraries/REST_Controller.php';

class Getdata extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // get all customer data stored in the sanction list
    function index_get()
    {
        $this->load->model('Sanctionlist_model');


        $employee = $this->Sanctionlist_model->get_all_data();


        $this->response($employee, 200);
    }

}