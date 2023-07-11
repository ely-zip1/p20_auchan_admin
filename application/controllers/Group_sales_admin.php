<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_sales_admin  extends CI_Controller
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

		// print_r($this->uri->segment(1).' ');
		// print_r($this->uri->segment(2).' ');
		// print_r($this->uri->segment(3).' ');
		// print_r($this->uri->segment(4).' ');
		// print_r($this->uri->segment(5).' ');
		
		$data = array(
			'title' => 'Group Sales'
		);

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['date_registered'] = $this->session->userdata('date_registered');

		$selected_month = "";

		if(isset($_POST['selected_month'])){
			$selected_month = $_POST['selected_month'];
		}else if($this->uri->segment(5) != null){
			$selected_month = $this->uri->segment(5);
		}else{
			$selected_month = date('m');
		}

		$page_count = 0;
		$search_term = "---";
		$member_list = array();
		if(isset($_POST['search_term'])){
			$member_list = $this->Members->search_members($_POST['search_term']);
			$search_term = $_POST['search_term'];
			$page_count = count($member_list) / 20;
		}else if($this->uri->segment(3) != "---"){
			$member_list = $this->Members->search_members($this->uri->segment(3));
			$search_term = $this->uri->segment(3);
			$page_count = count($member_list) / 20;
		}else{
			// $member_list = $this->Members->get_members(20,0);
			$member_list = $this->Members->get_all_members();
			$page_count = count($member_list) / 20;
		}


		// $member_data = $this->Members->get_member($this->session->username);
		// $data['member_id'] = $member_data->id;
		$data['selected_month'] = $selected_month;
		$data['search_term'] = $search_term;

		
		$member_bonus_list=array();
		foreach($member_list as $member){
			$temp_member['username'] = $member->username;
			$temp_member['full_name'] = $member->full_name;
			$temp_member['member_id'] = $member->id;

			$temp_bonus = $this->GroupSalesModel->get_bonus_by_user_by_month($member->id, $selected_month);

			// if($member->id == '97'){
			// 	print_r($temp_bonus);
			// }
			if($temp_bonus != null){
				$temp_member['bonus'] = $temp_bonus->bonus;
			}else{
				$temp_member['bonus'] = "0";
			}
			$temp_member['bonus_month'] = $selected_month;

			switch($selected_month){
				case "01":
					$temp_member['month_name'] = "Jan";
					break;
				case "02":
					$temp_member['month_name'] = "Feb";
					break;
				case "03":
					$temp_member['month_name'] = "Mar";
					break;
				case "04":
					$temp_member['month_name'] = "Apr";
					break;
				case "05":
					$temp_member['month_name'] = "May";
					break;
				case "06":
					$temp_member['month_name'] = "Jun";
					break;				
				case "07":
					$temp_member['month_name'] = "Jul";
					break;
				case "08":
					$temp_member['month_name'] = "Aug";
					break;	
				case "09":
					$temp_member['month_name'] = "Sep";
					break;
				case "10":
					$temp_member['month_name'] = "Oct";
					break;
				case "11":
					$temp_member['month_name'] = "Nov";
					break;
				case "12":
					$temp_member['month_name'] = "Dec";
					break;		
			}

			array_push($member_bonus_list, $temp_member);
		}


		$data['offset'] = 0;

		// print_r($member_list);

		$data['members'] = $member_bonus_list;
		// print_r($data['members']);


        if($this->form_validation->run() == FALSE){
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/pages/group_sales', $data);
            $this->load->view('admin/templates/footer');
        }
        else{
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/pages/group_sales', $data);
            $this->load->view('admin/templates/footer');
        }
  	}
	  
	//   public function apply_bonus(){
	// 	  $member = $this->Members->get_member_by_id($_POST['user_id']);
	// 	  if($member != null){
	// 		  $bonus = $_POST['member_bonus'];
	// 		  if(!isset($_POST['updateable'])){
	// 			if($bonus <= 0){
	// 				redirect('group_sales_admin/index/---/'
	// 				.$this->uri->segment(4).'/'
	// 				.$month);
	// 			}
	// 			}

	// 		  $month = $_POST['bonus_month'];

	// 		  $new['member_id'] = $member->id;
	// 		  $new['month'] = $month;
	// 		  $new['bonus'] = $bonus;

	// 			if($this->GroupSalesModel->get_bonus_by_user_by_month($member->id, $month) != null){
	// 				$this->GroupSalesModel->update($new);	
	// 			}else{
	// 				$this->GroupSalesModel->add($new);
	// 			}


	// 		  redirect('group_sales_admin/index/'
	// 		  .$this->uri->segment(3).'/'
	// 		  .$this->uri->segment(4).'/'
	// 		  .$month);
	// 	  }
	//   }

	
}