<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/26/2017
 * Time: 10:15 AM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Approvedata extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_post() {
        date_default_timezone_set('Asia/Jakarta');
        $approvedTime = date('Y-m-d H:i:s');

        $dataPost = array(
            'list_id'           => $this->post('list_id'),
            'full_name'          => $this->post('full_name'),
            'email'             => $this->post('email'),
            'phone_number'    => $this->post('phone_number'),
            'birthdate'        => $this->post('birthdate'),
            'gender' => $this->post('gender'),
            'input_by' => $this->post('input_by'),
            'input_time' => $this->post('input_time'),
            'approved_by' => $this->post('approved_by'),
            'approved_time' => $approvedTime);

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_data_post($dataPost);
        $this->Sanctionlist_model->set_approved_by($this->post('approved_by'));
        $this->Sanctionlist_model->set_approved_time($approvedTime);

        $insert = $this->Sanctionlist_model->post_approved_data();

        $confirmation = array(
            'code' => '4001',
            'message' => 'Insert data successful'
        );

        $errconfirm = array(
            'code' => '14001',
            'message' => 'Fail to insert data'
        );

        if ($insert) {
            $this->Sanctionlist_model->set_id($dataPost['list_id']);
            $this->Sanctionlist_model->set_action('insert');
            $this->Sanctionlist_model->insert_to_log();
            $this->Sanctionlist_model->delete_pending();
            $this->response($confirmation, 200);
        } else {
            $this->response($errconfirm, 502);
        }
    }

    function index_put()
    {
        //set default timezone
        date_default_timezone_set('Asia/Jakarta');
        $timeUpdateApproved = date('Y-m-d H:i:s');

        $list_id = $this->put('list_id');

        $dataUpdate = array();

        if (!empty($this->put('full_name'))) {
            $dataUpdate['full_name'] = $this->put('full_name');
        }

        if (!empty($this->put('phone_number'))) {
            $dataUpdate['phone_number'] = $this->put('phone_number');
        }

        if (!empty($this->put('email'))) {
            $dataUpdate['email'] = $this->put('email');
        }

        if (!empty($this->put('birthdate'))) {
            $dataUpdate['birthdate'] = $this->put('birthdate');
        }

        if (!empty($this->put('gender'))) {
            $dataUpdate['gender'] = $this->put('gender');
        }

        if (!empty($this->put('input_by'))) {
            $dataUpdate['input_by'] = $this->put('input_by');
        }

        if (!empty($this->put('input_time'))) {
            $dataUpdate['input_time'] = $this->put('input_time');
        }

        if (!empty($this->put('approved_by'))) {
            $dataUpdate['approved_by'] = $this->put('approved_by');
        }

        $dataUpdate['approved_time'] = $timeUpdateApproved;

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_id($list_id);
        $this->Sanctionlist_model->set_action('update');
        $this->Sanctionlist_model->set_data_update($dataUpdate);

        $this->Sanctionlist_model->set_approved_by($this->post('approved_by'));
        $this->Sanctionlist_model->set_approved_time($timeUpdateApproved);

        //process updating the data
        $update = $this->Sanctionlist_model->update_data();

        $confirmation = array(
            'code' => '4002',
            'message' => 'Data successfully updated.'
        );

        $errconfirm = array(
            'code' => '14002',
            'message' => 'Failed to update data.'
        );

        if ($update) {
            $this->Sanctionlist_model->insert_to_log();
            $this->Sanctionlist_model->delete_pending();
            $this->response($confirmation, 200);
        } else {
            $this->response($errconfirm, 502);
        }
    }

    function index_delete()
    {
        $list_id = $this->delete('list_id');

        //set default timezone setting
        date_default_timezone_set('Asia/Jakarta');
        $timeDeleteApproved = date('Y-m-d H:i:s');

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_id($list_id);
        $this->Sanctionlist_model->set_time_update($timeDeleteApproved);
        $this->Sanctionlist_model->set_action('delete');

        $this->Sanctionlist_model->set_approved_by($this->delete('approved_by'));
        $this->Sanctionlist_model->set_approved_time($timeDeleteApproved);

        //process delete data
        $delete = $this->Sanctionlist_model->delete_data();

        $confirmation = array(
            'code' => '4003',
            'message' => 'Data successfully deleted.'
        );

        if ($delete) {
            $this->Sanctionlist_model->insert_to_log();
            $this->Sanctionlist_model->delete_pending();
            $this->response($confirmation, 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}