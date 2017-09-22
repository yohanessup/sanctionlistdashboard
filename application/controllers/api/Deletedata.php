<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/22/2017
 * Time: 2:08 PM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Deletedata extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    //delete existing customer data stored in sanction list
    function index_delete()
    {
        $emp_id = $this->delete('id');
        $deleted_by = $this->delete('deleted_by');

        //set default timezone setting
        date_default_timezone_set('Asia/Jakarta');
        $timeUpdate = date('Y-m-d H:i:s');

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_id($emp_id);
        $this->Sanctionlist_model->set_time_update($timeUpdate);
        $this->Sanctionlist_model->set_action('delete');
        $this->Sanctionlist_model->set_user($deleted_by);

        //check if data id to be deleted is exist
        $dtToDel = $this->Sanctionlist_model->get_specific_data();

        $errMsg = array(
            'code' => '1001',
            'message' => 'Error: Data Not Found'
        );

        if (empty($dtToDel)) {
            $this->response($errMsg, 200);
            return;
        }

        //move old data before deleted to the other table
        $this->Sanctionlist_model->move_data();

        //process delete data
        $delete = $this->Sanctionlist_model->delete_data();

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