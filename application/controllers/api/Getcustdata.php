<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/27/2017
 * Time: 4:37 PM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Getcustdata extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // get all customer data stored in the sanction list
    function index_get()
    {
        $list_id = $this->get('list_id');
        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_id($list_id);
        $customer = $this->Sanctionlist_model->get_cust_data();


        $this->response($customer, 200);
    }

}