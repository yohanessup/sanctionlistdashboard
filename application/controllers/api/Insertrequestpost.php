<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 8/29/2017
 * Time: 9:20 AM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Insertrequestpost extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_post() {
        date_default_timezone_set('Asia/Jakarta');
        $createdTime = date('Y-m-d H:i:s');

        $dataPost = array(
            'list_id'           => $this->post('list_id'),
            'full_name'          => $this->post('full_name'),
            'email'             => $this->post('email'),
            'phone_number'    => $this->post('phone_number'),
            'birthdate'        => $this->post('birthdate'),
            'gender' => $this->post('gender'),
            'input_by' => $this->post('input_by'),
            'input_time' => $createdTime,
            'action_type' => 'insert');

        $this->load->model('Sanctionlist_model');

        $dataSearch = array(
            'full_name' => $dataPost['full_name'],
            'birthdate' => $dataPost['birthdate']
        );

        $this->Sanctionlist_model->set_data_search($dataSearch);
        $checkTempTable = $this->Sanctionlist_model->check_data_temp();
        $checkOrigTable = $this->Sanctionlist_model->check_data_orig();

        if(!empty($checkTempTable) || !empty($checkOrigTable)) {
            $this->response(array('code' => '3001', 'message' => 'Sorry, data has already exist!'), 200);
            return;
        }

        $this->Sanctionlist_model->set_data_post($dataPost);

        $insert = $this->Sanctionlist_model->post_pending_data();

        $confirmation = array(
            'code' => '2001',
            'message' => 'Insert data to pending post data successful'
        );

        if ($insert) {
            $this->response($confirmation, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}