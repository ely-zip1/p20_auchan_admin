<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Approved_deposits extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
  }

  public function index()
  {
    $data['title'] = 'Deposits';

    $approved_deposits = $this->DepositModel->get_approved();

    // print_r($approved_deposits);

    $deposit_data = array();
    foreach($approved_deposits as $approved){
      // print_r();
      if(isset($approved)){
        if(!$this->Members->is_exist($approved->member_id)){
          continue;
        }

        $member_data = $this->Members->get_member_by_id($approved->member_id);
        $deposit_mode = $this->Deposit_Options->get_by_id($approved->deposit_options_id);
        $package_data = $this->PackageModel->get_package_by_id($approved->package_id);

        $temp = array();

        $temp = array();
        $temp['id'] = $approved->id;
        $temp['client_name'] = ucfirst($member_data->full_name);
        $temp['email'] = $member_data->email_address;
        $temp['amount'] = $approved->amount;
        $temp['plan'] = $package_data->package_name;
        $temp['date'] = $approved->date;
        $temp['date_approved'] = $approved->date_approved;
        $temp['mode'] = $deposit_mode->name;

        array_push($deposit_data, $temp);
      }
    }

    $data['deposit_data'] = $deposit_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/approved_deposits', $data);
    $this->load->view('admin/templates/footer');
  }

  public function approve_deposit($deposit_id){

    $this->DepositModel->Approve_approved($deposit_id);
  }

}
