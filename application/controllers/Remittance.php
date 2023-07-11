<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Remittance extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Spar_fund_model');
    $this->load->model('Forex_model');
    $this->load->model('Remittance_model');
  }

  public function index()
  {
    $data['title'] = 'Remittance Services';

		$member_data = $this->Members->get_member($this->session->username);

    $spar_fund_balance = $this->Spar_fund_model->get_member_balance($member_data->id);
    $data['spar_fund_balance'] = number_format($spar_fund_balance, 2, '.', ',');

    $exchange_rate = $this->Forex_model->get_latest();
    $data['exchange_rate'] = number_format($exchange_rate->rate, 2, '.', ',');

    // print_r($spar_fund_balance);
    $sent_fund_history = array();
    $transactions = $this->Remittance_model->get_per_member_id($member_data->id);
    if($transactions != null)
      foreach($transactions as $trans){
        $history = array(
          'amount' => $trans->amount,
          'recipient' => $trans->first_name . ' ' .$trans->last_name,
          'reference' => $trans->reference,
          'date' => $trans->date
        );
        array_push($sent_fund_history, $history);

      }

    $data['sent_fund_history'] = $sent_fund_history;
    
    if(isset($_POST['transaction_type']))
      if($_POST['transaction_type'] == 'bank'){
        $this->form_validation->set_rules('bank_account_number', 'Bank account number', 'required');
        $this->form_validation->set_rules('bank_name', 'Bank name', 'required');
      }else{
        $this->form_validation->set_rules('bank_name', 'Remittance outlet', 'required');
      }
    
		$this->form_validation->set_rules('transaction_type', 'Transaction Type', 'required');
		$this->form_validation->set_rules('recipient_firstname', 'First name', 'required');
		$this->form_validation->set_rules('recipient_lastname', 'Last name', 'required');
		$this->form_validation->set_rules('recipient_country', 'Country', 'required');
		$this->form_validation->set_rules('recipient_address', 'Full address', 'required');
		$this->form_validation->set_rules('recipient_phone', 'Phone number', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|callback_verify_amount');

			if ($this->form_validation->run() == FALSE) {
        
        $this->load->view('pages/remittance', $data);
			} 
      else {
        $ref = $this->remittance_request($member_data->id, $exchange_rate->rate);

        $this->session->set_flashdata("reference_code", $ref);
        
        redirect('remittance','refresh');
      }		
    

  }

  public function remittance_request($member_id, $exchange_rate){
    $transactionType = $_POST['transaction_type'];
    $firstName = $_POST['recipient_firstname'];
    $middleName = $_POST['recipient_middlename'];
    $lastName = $_POST['recipient_lastname'];
    $bankName = $_POST['bank_name'];
    $bankAccountNumber = $_POST['bank_account_number'];
    $country = $_POST['recipient_country'];
    $address = $_POST['recipient_address']; 
    $phone = $_POST['recipient_phone']; 
    $amount = $_POST['amount']; 
    $transaction_type = $_POST['transaction_type']; 

    $bytes = random_bytes(5);
    $ref = strtoupper(bin2hex($bytes));

    $data = array(
      'first_name' => $firstName,
      'middle_name' => $middleName,
      'last_name' => $lastName,
      'bank_name' => $bankName,
      'bank_account_number' => $bankAccountNumber,
      'address' => $address,
      'country' => $country,
      'phone_number' => $phone,
      'member_id' => $member_id,
      'amount' => $amount,
      'conversion_rate' => $exchange_rate,
      'transaction_type' => $transaction_type,
      'reference' => $ref
    );

    $this->Remittance_model->add($data);

    return $ref;
  }

  public function verify_amount(){
    
    $spar_fund_balance = $this->Spar_fund_model->get_member_balance($this->session->user_id);
    $send_amount = $_POST['amount'];

    // print_r($send_amount);
    // print_r($spar_fund_balance);

    if($send_amount <= $spar_fund_balance){
      return true;
    }else{
			$this->form_validation->set_message('verify_amount', 'Invalid amount.');
      return false;
    }
  }
}