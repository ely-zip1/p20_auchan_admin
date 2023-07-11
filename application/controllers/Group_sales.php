<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_sales  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PackageModel');
		$this->load->model('DepositModel');
		$this->load->model('Members');
		$this->load->model('Deposit_Options');
		$this->load->model('WithdrawalModel');
		$this->load->model('Referral_bonus_model');
		$this->load->model('Fund_transfer_model');
		$this->load->model('Referral_codes');
		$this->load->model('Fund_bonus_model');
		$this->load->model('GroupSalesModel');

		date_default_timezone_set('Asia/Manila');
	}

	public function index()
	{
		$data = array(
			'title' => 'Monthly Bonus'
		);

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['date_registered'] = $this->session->userdata('date_registered');

		$member_data = $this->Members->get_member($this->session->username);

		$bonuses = $this->GroupSalesModel->get_all_per_member($member_data->id);

		// print_r($bonuses);

		$total_group_bonus = 0;
		$history = array();
		foreach($bonuses as $bonus){
			$temp = array();
			switch($bonus->month){
				case "01":
					$temp['month_name'] = "January";
					break;
				case "02":
					$temp['month_name'] = "February";
					break;
				case "03":
					$temp['month_name'] = "March";
					break;
				case "04":
					$temp['month_name'] = "April";
					break;
				case "05":
					$temp['month_name'] = "May";
					break;
				case "06":
					$temp['month_name'] = "June";
					break;				
				case "07":
					$temp['month_name'] = "July";
					break;
				case "08":
					$temp['month_name'] = "August";
					break;	
				case "09":
					$temp['month_name'] = "September";
					break;
				case "10":
					$temp['month_name'] = "October";
					break;
				case "11":
					$temp['month_name'] = "November";
					break;
				case "12":
					$temp['month_name'] = "December";
					break;	
					
					
					}
					$temp['amount'] = number_format($bonus->bonus, 2, '.', ',');

					array_push($history, $temp);

					$total_group_bonus += $bonus->bonus;
				}

			$data['total_bonus'] = number_format($total_group_bonus, 2, '.', ',');
				
			$data['bonus_history'] = $history;
			
			$this->load->view('pages/group_sales', $data);
		
        }

  }