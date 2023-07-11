<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Rewards extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->model('Account_model');
  }

  public function index()
  {
    $data['title'] = 'Redeemable Items';
    $data['username'] = $this->session->userdata('username');
    $data['fullname'] = $this->session->userdata('fullname');
    
    $account_balance = $this->Account_model->get_account_balance($this->session->user_id);

    $this->load->view('pages/rewards', $data);
  } 

}