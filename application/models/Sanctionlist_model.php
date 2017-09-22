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

    const tableName = 'list';

    const oldTableName = 'oldlist';

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

    function get_all_data() {
        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function get_data() {
        $query = $this->db->get($this::tableName);

        return $query->result_array();
    }

    function get_specific_data() {
        $this->db->where('rec_id', $this->id);
        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function post_data() {
        $insert = $this->db->insert($this::tableName, $this->dataPost);

        return $insert;
    }

    function update_data() {
        $this->db->where('rec_id', $this->id);
        $update = $this->db->update($this::tableName, $this->dataUpdate);

        return $update;
    }

    function move_data() {
        $this->db->where('rec_id', $this->id);
        $q = $this->db->get($this::tableName)->result();
        foreach($q as $r) {
            $data = array(
                'list_id'           => $r->list_id,
                'full_name'          => $r->full_name,
                'phone_number'    => $r->phone_number,
                'birthdate'        => $r->birthdate,
                'gender' => $r->gender,
                'created_at' => $this->timeUpdate,
                'user' => $this->user,
                'action' => $this->action);
            $this->db->insert($this::oldTableName, $data);
        }
    }

    function delete_data() {
        $delete = $this->db->delete($this::tableName,  array('rec_id' => $this->id));

        return $delete;
    }

    function match_data(){
        $this->db->where($this->dataSearch);
        $query = $this->db->get($this::tableName);

        return $query->result();
    }
}