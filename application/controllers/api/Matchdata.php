<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/22/2017
 * Time: 10:41 AM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Matchdata extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // get all customer data stored in the sanction list
    function index_get()
    {
        $dataSearch = array(
          'full_name' => $this->get('full_name'),
          'birthdate' => $this->get('birthdate'),
          'gender' => $this->get('gender')
        );

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_data_search($dataSearch);
        $result = $this->Sanctionlist_model->match_data();

        if (!empty($result)) {
            $this->response(array('code' => '2004', 'message' => 'DATA MATCH'), 200);
        } else {
            $this->response(array('code' => '2005', 'message' => 'DATA NOT MATCH'), 502);
        }
    }

}