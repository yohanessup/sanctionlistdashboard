<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 8/29/2017
 * Time: 9:20 AM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Postdata extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }


    // insert new customer data to be included in the sanction list
    //list id is generated from microtime
    //other params are from post params
    function index_post() {
        $list_id = md5(microtime());
        $dataPost = array(
            'list_id'           => $list_id,
            'full_name'          => $this->post('full_name'),
            'phone_number'    => $this->post('phone_number'),
            'birthdate'        => $this->post('birthdate'),
            'gender' => $this->post('gender'),
            'created_by' => $this->post('created_by'));

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_data_post($dataPost);

        $insert = $this->Sanctionlist_model->post_data();

        $confirmation = array(
            'code' => '2001',
            'message' => 'Insert data successful'
        );

        if ($insert) {
            $this->response($confirmation, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}