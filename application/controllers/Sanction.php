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


    function index()
    {
        $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));

        if(isset($this->session->userdata['logged_in'])){
            $this->load->view('home', $data);
        } else {
            if (isset($_POST['submit'])) {
                $loginData = array(
                    'user_id' => $this->input->post('user_id'),
                    'password' => $this->input->post('password'));

                $loginUser = $this->curl->simple_get($this->API . '/getuser', $loginData, array(CURLOPT_BUFFERSIZE => 10));
                $userData = json_decode($loginUser);
                if (!empty($userData)) {
                    $session_data = array(
                        'username' => $userData[0]->username,
                        'user_group' => $userData[0]->user_group,
                    );
                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('home', $data);
                } else {
                    $data = array(
                        'error_message' => 'Invalid Username or Password. Please try again.'
                    );
                    $this->load->view('login', $data);
                }
            } else {
                $this->load->view('login');
            }
        }
    }

    // show customer data stored in the sanction list
    function get(){
        $data['custdata'] = json_decode($this->curl->simple_get($this->API.'/getdata'));
        $this->load->view('home',$data);
    }

    function baru() {
        if(isset($this->session->userdata['logged_in'])) {
            date_default_timezone_set('Asia/Jakarta');
            $inputTime = date('Y-m-d H:i:s');

            if (isset($_POST['submit'])) {
                $data = array(
                    'list_id' => md5(microtime()),
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'phone_number' => $this->input->post('phone_number'),
                    'birthdate' => $this->input->post('birthdate'),
                    'gender' => $this->input->post('gender'),
                    'input_by' => $this->session->userdata['logged_in']['username'],
                    'input_time' => $inputTime);

                $this->curl->simple_post($this->API . '/insertrequestpost', $data, array(CURLOPT_BUFFERSIZE => 10));
                $userGroup = $this->session->userdata['logged_in']['user_group'];
                if ($userGroup == 99){
                    $data['approved_by'] = $this->session->userdata['logged_in']['username'];
                    $data['approved_time'] = $inputTime;
                    $dataApproved[] = $data;
                    $insert = $this->curl->simple_post($this->API . '/approvedata', $dataApproved[0], array(CURLOPT_BUFFERSIZE => 10));
                }

                if ($insert) {
                    $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));
                    $data['message'] = 'Data successfully added.';
                    $this->load->view('home', $data);
                } else {
                    $data['message'] = 'Insert data failed.';
                    $this->load->view('home', $data);
                }
            } else {
                $this->load->view('newdata');
            }
        } else {
            $this->load->view('login');
        }
    }

    function logout() {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('login', $data);
    }

}
