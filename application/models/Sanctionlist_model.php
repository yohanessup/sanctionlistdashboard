<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/14/2017
 * Time: 9:42 AM
 */

class Sanctionlist_model extends CI_Model{

    var $dataPost = array();

    var $dataUpdate = array();

    var $dataSearch = array();

    var $timeUpdate = array();

    var $action;

    var $user;

    var $fullName;

    var $birthDate;

    var $userLoginData;

    var $approvedTime;

    var $approvedBy;

    const tableName = 'approved';

    const userTable = 'user';

    const oldTableName = 'log';

    const newTableName = 'pending';

    var $id;

    function set_data_post($data_post) {
        $this->dataPost = $data_post;
    }

    function set_data_update($data_update) {
        $this->dataUpdate = $data_update;
    }

    function set_data_search($data_search) {
        $this->dataSearch = $data_search;
    }

    function set_id($record_id) {
        $this->id = $record_id;
    }

    function set_time_update($time_updt) {
        $this->timeUpdate = $time_updt;
    }

    function set_action($sql_action) {
        $this->action = $sql_action;
    }

    function set_user($user) {
        $this->user = $user;
    }

    function set_userlogin_data($user) {
        $this->userLoginData = $user;
    }

    function set_approved_time($app_time) {
        $this->approvedTime = $app_time;
    }

    function set_approved_by($app_by) {
        $this->approvedBy = $app_by;
    }

    function set_birthdate($bdate){
        $this->birthDate = $bdate;
    }

    function set_fullname($fullname){
        $this->fullName = $fullname;
    }

    function get_all_data() {
        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function get_cust_data() {
        $this->db->where('list_id', $this->id);
        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function get_user_data() {
        $this->db->where($this->userLoginData);
        $query = $this->db->get($this::userTable);

        return $query->result();
    }

    function post_pending_data() {
        $table = $this::newTableName;
        $insert = $this->db->insert($table, $this->dataPost);

        return $insert;
    }

    function post_approved_data() {
        $table = $this::tableName;
        $insert = $this->db->insert($table, $this->dataPost);

        return $insert;
    }

    function post_log_data() {
        $table = $this::oldTableName;
        $insert = $this->db->insert($table, $this->dataPost);

        return $insert;
    }

    function update_data() {
        $this->db->where('list_id', $this->id);
        $update = $this->db->update($this::tableName, $this->dataUpdate);

        return $update;
    }

    function insert_to_log() {
        $this->db->where('list_id', $this->id);
        $q = $this->db->get($this::newTableName)->result();
        foreach($q as $r) {
            $data = array(
                'list_id'           => $r->list_id,
                'full_name'          => $r->full_name,
                'email'             => $r->email,
                'phone_number'    => $r->phone_number,
                'birthdate'        => $r->birthdate,
                'gender' => $r->gender,
                'input_time' => $r->input_time,
                'input_by' => $r->input_by,
                'approved_time' => $this->approvedTime,
                'approved_by' => $this->approvedBy,
                'action_type' => $this->action);
            $this->db->insert($this::oldTableName, $data);
        }
    }

    function delete_data() {
        $delete = $this->db->delete($this::tableName,  array('list_id' => $this->id));

        return $delete;
    }

    function delete_pending() {
        $delete = $this->db->delete($this::newTableName,  array('list_id' => $this->id));

        return $delete;
    }

    function match_data(){
        $this->db->where($this->dataSearch);
        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function check_data_temp() {
        $this->db->where($this->dataSearch);
        $query = $this->db->get($this::newTableName);

        return $query->result();
    }

    function check_data_orig() {
        $this->db->where($this->dataSearch);

        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function check_data_orig_update() {
        $this->db->where('full_name =', $this->dataSearch['full_name']);
        $this->db->where('birthdate =', $this->dataSearch['birthdate']);
        $this->db->where('list_id !=', $this->dataSearch['list_id']);

        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function check_id_data_temp() {
        $this->db->where('list_id', $this->id);
        $query = $this->db->get($this::newTableName);

        return $query->result();
    }
}