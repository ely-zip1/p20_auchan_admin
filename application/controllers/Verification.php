<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verification extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
						$this->load->model('Members');

            date_default_timezone_set('Asia/Manila');
        }

	public function index()
	{
    $data = array(
      'title' => 'Verification'
    );

    $verification_code = "";

    if(isset($_POST['v_code'])){
      $verification_code = $_POST['v_code'];
      if(strlen($verification_code) > 0){

          if($this->Members->is_valid_v_code($verification_code)){

            $this->Members->verified($verification_code);
            $data['status'] = true;
            $data['message'] = 'ACCOUNT VERIFIED!';
          }
          else{
            $data['status'] = false;
            $data['message'] = 'Account verification failed! Invalid code.';
          }
      }
    }
    
      $this->load->view('login/header', $data);
      $this->load->view('login/verify', $data);
      $this->load->view('login/footer');
    // else{
    //       $this->load->view('login/header', $data);
    //       $this->load->view('login/verification', $data);
    //       $this->load->view('login/footer');
    // }


  }

}