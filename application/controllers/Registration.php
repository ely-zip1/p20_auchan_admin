<!-- <?php

class Registration extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Members');
    $this->load->model('Referral_codes');
    $this->load->model('ReferralModel');
    $this->load->model('Withdrawal_Mode_model');
    $this->load->model('Bank_model');

    date_default_timezone_set('Asia/Manila');
  }

  public function index($referral_code = '')
  {
    $data = array(
      'title' => "Registration"
    );


    if (isset($referral_code)) {
      if ($this->Members->has_duplicate_username($referral_code)) {
        $data['referral_code'] = $referral_code;
      } else {
        $data['referral_code'] = '';
        // $data['referral_code'] = $this->Referral_codes->get_root_code();
      }
    }

    $this->form_validation->set_rules('fullname', 'Full Name', 'required');
    $this->form_validation->set_rules('reg_country', 'Country', 'required');
    // $this->form_validation->set_rules('birthday', 'Birthay', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required|callback_is_new_username|callback_validate_username');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_is_new_email');
    $this->form_validation->set_rules('confirm_email', 'Email Confirmation', 'required|matches[email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|min_length[6]|matches[password]');
    // $this->form_validation->set_rules('beneficiary', 'Beneficiary Name', 'required');
    $this->form_validation->set_rules('referral', 'Referral Code', 'required|callback_verify_referral');


    if ($this->form_validation->run() == FALSE) {
      // echo "failed validation";
      $this->load->view('login/registration', $data);
    } else {
      // echo "success validation";

      //   $refcode = $this->Referral_codes->get_new_code();
      //   $refcode->is_taken = '1';
      //   $this->Referral_codes->take_code($refcode);

      $options = [
        'cost' => 11
      ];
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

      $verification_code = "AVIA";

      $user_data = array(
        'full_name' => $_POST['fullname'],
        'username' => $_POST['username'],
        'email_address' => $_POST['email'],
        'date' => date('Y-m-d H:i:s'),
        'password' => $password,
        'account_type_id' => '2',
        'country' => $_POST['reg_country'],
        //   'birthdate' => $_POST['birthday'],
        'verified' => '1',
        'verification_code' => $verification_code,
        // 'beneficiary' => $_POST['beneficiary'],
        'referred_by' => $_POST['referral']
      );


      $this->Members->add_member($user_data);

      if ($this->Members->verify_member($user_data['username'], $_POST['password'])) {
        // echo "success";
        //   $referrer_code = $this->Referral_codes->get_by_code($_POST['referral']);
        //   $referrer_data = $this->Members->get_member_by_referral_id($referrer_code->id);
        $new_member = $this->Members->get_member($user_data['username']);

        //   $new_referral = array(
        //       'referrer_id' => $referrer_data->id,
        //       'referee_id' => $new_member->id
        //   );

        $members_bank = array('member_id' => $new_member->id);
        $this->Bank_model->add($members_bank);
        $this->Withdrawal_Mode_model->add($members_bank);

        //   $this->ReferralModel->add_referral($new_referral);

        // $this->send_verification_email($_POST['email'], $verification_code);
        // $this->send_welcome_email($user_data["email_address"], ucwords($user_data["full_name"]), $verification_code);

        $this->session->set_flashdata("reg_status", "success");

        unset($_POST);

        // redirect('verification', 'refresh');
        redirect('login');
      } else {
        // echo "failed";
        //   $this->load->view('login/header', $data);
        $this->load->view('login/registration', $data);
        //   $this->load->view('login/footer');
      }
    }
  }

  function is_new_email()
  {

    if ($this->Members->has_duplicate_email($_POST['email'])) {
      $this->form_validation->set_message('is_new_email', 'Email address already exists.');
      return false;
    } else {
      return true;
    }
  }

  function is_new_username()
  {

    if ($this->Members->has_duplicate_username($_POST['username'])) {
      $this->form_validation->set_message('is_new_username', 'Username already taken.');
      return false;
    } else {
      return true;
    }
  }

  public function verify_referral()
  {
    $valid = $this->Members->verify_member_code($_POST['referral']);

    if ($valid) {
      return true;
    } else {
      $this->form_validation->set_message('verify_referral', 'Invalid referral code.');

      return false;
    }
  }

  public function validate_username(){
    if ( !preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $_POST['username']) ){
      $this->form_validation->set_message('validate_username', 'Username must be at least 6 alphanumeric characters long.');
      return false;
    }else{
      return true;
    }
  }

  // public function verify_referral(){
  //     $valid = $this->Referral_codes->verify_member_code($_POST['referral']);

  //     if($valid){
  //         return true;
  //     }else{
  //         $this->form_validation->set_message('verify_referral', 'Invalid referral code.');

  //         return false;
  //     }
  // }
} -->