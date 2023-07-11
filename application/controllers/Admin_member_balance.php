<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_member_balance extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Account_model');
  }

  public function index()
  {
    $data['title'] = 'Member Balance';

    $member_list = $this->Members->get_all_members();

    // print_r($approved_deposits);

    $balance_data = array();
    foreach($member_list as $member){
      // print_r();
      if(isset($member)){
        if($member->id == "6" || $member->id == "56" || $member->id == "127" || $member->id == "128" || $member->id == "129" || $member->id == "134"){
          continue;
        }


        $temp = array();

        $temp = array();
        $temp['id'] = $member->id;
        $temp['client_name'] = ucfirst($member->full_name);
        $temp['email'] = $member->email_address;
        $temp['balance'] = number_format($this->Account_model->get_account_balance($member->id), 2);

        array_push($balance_data, $temp);
      }
    }

    $data['balance_data'] = $balance_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/admin_member_balance', $data);
    $this->load->view('admin/templates/footer');
  }

}