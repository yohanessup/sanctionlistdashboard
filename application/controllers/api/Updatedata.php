<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/22/2017
 * Time: 10:59 AM
 */

require APPPATH . 'libraries/REST_Controller.php';

class Updatedata extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

// update customer data save in the sanction list
// update time in local time "Asia/Jakarta"
// before updating the data, move the old data to the other table "oldlist"
    function index_put()
    {
        date_default_timezone_set('Asia/Jakarta');
        $timeUpdate = date('Y-m-d H:i:s');

        $emp_id = $this->put('id');

        $dataUpdate = array();

        if (!empty($this->put('full_name'))) {
            $dataUpdate['full_name'] = $this->put('full_name');
        }

        if (!empty($this->put('phone_number'))) {
            $dataUpdate['phone_number'] = $this->put('phone_number');
        }

        if (!empty($this->put('birthdate'))) {
            $dataUpdate['birthdate'] = $this->put('birthdate');
        }

        if (!empty($this->put('gender'))) {
            $dataUpdate['gender'] = $this->put('gender');
        }

        if (!empty($this->put('updated_by'))) {
            $dataUpdate['updated_by'] = $this->put('updated_by');
        }

        $dataUpdate['updated_at'] = $timeUpdate;

        $this->load->model('Sanctionlist_model');

        $this->Sanctionlist_model->set_id($emp_id);
        $this->Sanctionlist_model->set_data_update($dataUpdate);
        $this->Sanctionlist_model->set_time_update($timeUpdate);
        $this->Sanctionlist_model->set_action('update');
        $this->Sanctionlist_model->set_user($dataUpdate['updated_by']);

        $this->Sanctionlist_model->move_data();

        $update = $this->Sanctionlist_model->update_data();

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

}