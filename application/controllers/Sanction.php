<?php

class Sanction extends CI_Controller {

    var $API ="";

    function __construct() {
        parent::__construct();
        $this->baseURL = $this->config->item('base_url');
        $this->API=$this->baseURL.'/api';
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

                $insertPending = $this->curl->simple_post($this->API . '/insertrequestpost', $data, array(CURLOPT_BUFFERSIZE => 10));
                $insertPendingResult = json_decode($insertPending);
                $userGroup = $this->session->userdata['logged_in']['user_group'];
                if ($insertPendingResult->code == 2001 && $userGroup == 99){
                    $data['approved_by'] = $this->session->userdata['logged_in']['username'];
                    $data['approved_time'] = $inputTime;
                    $dataApproved[] = $data;
                    $insert = $this->curl->simple_post($this->API . '/approvedata', $dataApproved[0], array(CURLOPT_BUFFERSIZE => 10));
                } else {
                    $data['message'] = $insertPendingResult->message;
                    $this->load->view('newdata', $data);
                    return;
                }

                if ($insert) {
                    $insertResult = json_decode($insert);
                    if ($insertResult->code == 4001) {
                        $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));
                    }
                    $data['message'] = $insertResult->message;
                } else {
                    $data['message'] = 'Insert data failed.';
                }
                $this->load->view('home', $data);
            } elseif (isset($_POST['cancel'])) {
                $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));
                $data['message'] = 'Action cancelled.';
                $this->load->view('home', $data);
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

    function edit() {
        if(isset($this->session->userdata['logged_in'])) {
            date_default_timezone_set('Asia/Jakarta');
            $inputTime = date('Y-m-d H:i:s');

            if (isset($_POST['submit'])) {
                $data = array(
                    'list_id' => $this->input->post('list_id'),
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'phone_number' => $this->input->post('phone_number'),
                    'birthdate' => $this->input->post('birthdate'),
                    'gender' => $this->input->post('gender'),
                    'input_by' => $this->session->userdata['logged_in']['username'],
                    'input_time' => $inputTime);

                $insertPending = $this->curl->simple_post($this->API . '/insertrequestupdate', $data, array(CURLOPT_BUFFERSIZE => 10));
                $insertPendingResult = json_decode($insertPending);
                $userGroup = $this->session->userdata['logged_in']['user_group'];
                if ($insertPendingResult->code == 2002 && $userGroup == 99){
                    $data['approved_by'] = $this->session->userdata['logged_in']['username'];
                    $data['approved_time'] = $inputTime;
                    $dataApproved[] = $data;
                    $insert = $this->curl->simple_put($this->API . '/approvedata', $dataApproved[0], array(CURLOPT_BUFFERSIZE => 10));
                } else {
                    $params = array('list_id' => $this->session->userdata['custsanction']['list_id']);
                    $data['custdata'] = json_decode($this->curl->simple_get($this->API.'/getcustdata',$params));
                    $data['message'] = $insertPendingResult->message;
                    $this->load->view('editdata', $data);
                    return;
                }

                if ($insert) {
                    $insertResult = json_decode($insert);
                    if($insertResult->code == 4002) {
                        $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));
                    }
                    $data['message'] = $insertResult->message;
                    $sess_array = array(
                        'list_id' => ''
                    );
                    $this->session->unset_userdata('custsanction', $sess_array);
                } else {
                    $data['message'] = 'Edit data failed.';
                }
                $this->load->view('home', $data);
            } elseif (isset($_POST['cancel'])) {
                $data['custdata'] = json_decode($this->curl->simple_get($this->API.'/getdata'));
                $data['message'] = 'Action cancelled.';
                $this->load->view('home', $data);
            } else {
                $params = array('list_id'=>  $this->uri->segment(3));
                $this->session->set_userdata('custsanction', $params);
                $data['custdata'] = json_decode($this->curl->simple_get($this->API.'/getcustdata',$params));
                $this->load->view('editdata', $data);
            }
        } else {
            $this->load->view('login');
        }
    }

    function delete($id){
        if(empty($id)){
            if(isset($this->session->userdata['logged_in'])) {
                $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));
                $this->load->view('home', $data);
            } else {
                $this->load->view('login');
            }
        }else{
            if(isset($this->session->userdata['logged_in'])) {
                date_default_timezone_set('Asia/Jakarta');
                $inputTime = date('Y-m-d H:i:s');
                $params = array('list_id'=>  $id);
                $data = json_decode($this->curl->simple_get($this->API.'/getcustdata',$params));
                $dVal = array();
                foreach ($data as $dataVal){
                    $dVal['list_id'] = $dataVal->list_id;
                    $dVal['full_name'] = $dataVal->full_name;
                    $dVal['email'] = $dataVal->email;
                    $dVal['phone_number'] = $dataVal->phone_number;
                    $dVal['birthdate'] = $dataVal->birthdate;
                    $dVal['gender'] = $dataVal->gender;
                    $dVal['input_by'] = $this->session->userdata['logged_in']['username'];
                    $dVal['input_time'] = $inputTime;
                }

                $insertPending = $this->curl->simple_post($this->API.'/insertrequestdelete', $dVal, array(CURLOPT_BUFFERSIZE => 10));
                $insertPendingResult = json_decode($insertPending);
                $userGroup = $this->session->userdata['logged_in']['user_group'];

                $data['custdata'] = json_decode($this->curl->simple_get($this->API . '/getdata'));

                if ($insertPendingResult->code == 2003 && $userGroup == 99){
                    $delete = $this->curl->simple_delete($this->API . '/approvedata', array('list_id' => $id), array(CURLOPT_BUFFERSIZE => 10));
                } else {
                    $data['message'] = $insertPendingResult->message;
                    $this->load->view('home', $data);
                    return;
                }

                if ($delete) {
                    $deleteResult = json_decode($delete);
                    $data['message'] = $deleteResult->message;
                    $this->session->set_flashdata('msg', $data['message']);
                    redirect('sanction');
                } else {
                    $data['message'] = 'Delete data failed.';
                    $this->load->view('home', $data);
                }


            } else {
                $this->load->view('login');
            }
        }
    }

}
