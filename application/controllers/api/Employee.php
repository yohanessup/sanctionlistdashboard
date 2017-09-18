<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 8/29/2017
 * Time: 9:20 AM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Employee extends REST_Controller {

    var $data = array();

    function setData($rec_data)
    {
        $this->data = $rec_data;
    }

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show employee data
    function index_get()
    {
        $emp_id = $this->get('id');
        $this->load->model('Employee_model');

        if ($emp_id == '') {
            $employee = $this->Employee_model->get_all_data();
        } else {
            $this->Employee_model->set_id($emp_id);
            $employee = $this->Employee_model->get_specific_data();
        }

        $this->response($employee, 200);
    }

    // insert new employee data
    function index_post() {

        $dataPost = array(
            'first_name'           => $this->post('first_name'),
            'last_name'          => $this->post('last_name'),
            'email'    => $this->post('email'),
            'gender'        => $this->post('gender'),
            'phone_number' => $this->post('phone_number'));

        $this->load->model('Employee_model');

        $this->Employee_model->set_data_post($dataPost);

        $insert = $this->Employee_model->post_data();

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

    // update employee data
    function index_put() {
        $emp_id = $this->put('id');
        $dataUpdate = array(
            'first_name'       => $this->put('first_name'),
            'last_name'      => $this->put('last_name'),
            'email' => $this->put('email'),
            'gender'    => $this->put('gender'),
            'phone_number'    => $this->put('phone_number'));
        $this->load->model('Employee_model');

        $this->Employee_model->set_id($emp_id);
        $this->Employee_model->set_data_update($dataUpdate);

        $update = $this->Employee_model->update_data();

        $confirmation = array(
            'code' => '2002',
            'message' => 'Update data successful'
        );

        if ($update) {
            $this->response($confirmation, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete existing employee data
    function index_delete() {
        $emp_id = $this->delete('id');
        $this->load->model('Employee_model');

        $this->Employee_model->set_id($emp_id);
        $delete = $this->Employee_model->delete_data();

        $confirmation = array(
            'code' => '2003',
            'message' => 'Delete data successful'
        );

        if ($delete) {
            $this->response($confirmation, 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}