<?php

class Sanction extends CI_Controller {

    var $API ="";

    function __construct() {
        parent::__construct();
        $this->API=$this->config->item('base_url').'/api';
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    // show customer data stored in the sanction list
    function index(){
        $data['custdata'] = json_decode($this->curl->simple_get($this->API.'/getdata'));
        $this->load->view('home',$data);
    }
}
