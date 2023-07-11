<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Approved_withdrawals extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('WithdrawalModel');
    $this->load->model('Members');
    $this->load->model('PackageModel');
  }

  public function index()
  {
    $data['title'] = 'Withdrawals';

    $approved_withdrawals = $this->WithdrawalModel->get_approved();

    // print_r($pending_withdrawals);

    $withdrawal_data = array();
    foreach($approved_withdrawals as $approved){
      // print_r();

      if(!$this->Members->is_exist($approved->member_id)){
        continue;
      }

      $member_data = $this->Members->get_member_by_id($approved->member_id);

      $temp = array();
      $temp['id'] = $approved->id;
      $temp['client_name'] = ucfirst($member_data->full_name);
      $temp['amount'] = $approved->amount;
      $temp['email'] = $member_data->email_address;
      $temp['mode'] = $approved->payment_method;
      $temp['date'] = $approved->date;
      $temp['date_approved'] = $approved->date_approved;

      array_push($withdrawal_data, $temp);
    }

    $data['withdrawal_data'] = $withdrawal_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/approved_withdrawals', $data);
    $this->load->view('admin/templates/footer');
  }

}
