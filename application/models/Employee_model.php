<?php
/**
 * Created by PhpStorm.
 * User: YohanesSuprapto
 * Date: 9/14/2017
 * Time: 9:42 AM
 */

class Employee_model extends CI_Model{

    var $dataPost = array();

    var $dataUpdate = array();

    const tableName = 'employees';

    var $id;

    function set_data_post($data_post) {
        $this->dataPost = $data_post;
    }

    function set_data_update($data_update) {
        $this->dataUpdate = $data_update;
    }

    function set_id($record_id) {
        $this->id = $record_id;
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
        $this->db->where('id', $this->id);
        $query = $this->db->get($this::tableName);

        return $query->result();
    }

    function post_data() {
        $insert = $this->db->insert($this::tableName, $this->dataPost);

        return $insert;
    }

    function update_data() {
        $this->db->where('id', $this->id);
        $update = $this->db->update($this::tableName, $this->dataUpdate);

        return $update;
    }

    function delete_data() {
        $delete = $this->db->delete($this::tableName,  array('id' => $this->id));

        return $delete;
    }
}