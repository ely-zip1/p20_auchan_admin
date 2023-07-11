<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Email_test extends CI_Controller
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
    $data['title'] = 'Authentication';
    $data['member_name'] = "Mang Tomas";
    $data['verification_code'] = "jk43k7";
    // $data['member_username'] = "Tomas34";
    // $data['auth_code'] = "jk43k7";


    // $this->load->view('email/authentication', $data);
    $this->load->view('email/welcome', $data);

    // $this->load->view('login/authorize', $data);
  }

  public function send()
  {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $this->load->library('email');

    $userdata['member_name'] = "mang tomas";
    $userdata['verification_code'] = "70531";

    $this->email->from('member_support@amico-members.com', 'Amico Group')
      ->to('gracure21@gmail.com')
      ->subject('Login Authentication')
      ->message($this->load->view('email/welcome', $userdata, true));

    if ($this->email->send()) {
      echo "sent";
    } else {
      echo "error sending";
    }
  }
}