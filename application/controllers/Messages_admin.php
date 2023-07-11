<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Messages_admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Members');
    $this->load->model('Message_model');
  }

  public function index()
  {
    $data['title'] = 'Messages';

    $messages = $this->Message_model->get_all();

    // print_r($approved_deposits);

    $message_data = array();
    foreach($messages as $msg){
      // print_r();
      if(isset($msg)){
        if(!$this->Members->is_exist($msg->member_id)){
          continue;
        }

        $member_data = $this->Members->get_member_by_id($msg->member_id);

        $temp = array();

        $temp = array();
        $temp['id'] = $msg->id;
        $temp['client_name'] = ucfirst($member_data->full_name);
        $temp['email'] = $member_data->email_address;
        $temp['date'] = $msg->date;
        $temp['message'] = $msg->message;

        array_push($message_data, $temp);
      }
    }

    $data['message_data'] = $message_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/messages_admin', $data);
    $this->load->view('admin/templates/footer');
  } 

}