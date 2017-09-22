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

        date_default_timezone_set('Asia/Jakarta');
        $timeUpdate = date('Y-m-d H:i:s');

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_id($emp_id);
        $this->Sanctionlist_model->set_time_update($timeUpdate);
        $this->Sanctionlist_model->set_action('delete');
        $this->Sanctionlist_model->set_user($deleted_by);

        $this->Sanctionlist_model->move_data();

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