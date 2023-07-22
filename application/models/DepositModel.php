<?php

class DepositModel extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();

    date_default_timezone_set('Asia/Manila');
  }

  public function add_deposit($depositArray)
  {

    $this->db->insert('td_deposits', $depositArray);
  }

  public function get_deposit_per_member($member_id)
  {
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_deposits');

    return $query->result();
  }

  public function has_deposit($member_id)
  {
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_deposits', 1);

    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function has_active_deposit($member_id)
  {
    $this->db->where('member_id', $member_id);
    $this->db->where('is_pending', 0);
    $query = $this->db->get('td_deposits', 1);

    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function get_pending()
  {
    $this->db->where('is_pending', '1');
    $query = $this->db->get('td_deposits');

    return $query->result();
  }

  public function get_by_id($deposit_id)
  {
    $this->db->where('id', $deposit_id);
    $query = $this->db->get('td_deposits');

    return $query->row();
  }

  public function get_approved()
  {
    $this->db->where('is_pending', '0');
    $query = $this->db->get('td_deposits');

    return $query->result();
  }
  public function get_approved_per_member($member_id)
  {
    $this->db->where('member_id', $member_id);
    $this->db->where('is_pending', '0');
    $this->db->order_by('date_approved', 'DESC');
    $query = $this->db->get('td_deposits');

    return $query->result();
  }

  public function get_total_growth($member_id)
  {

    date_default_timezone_set('Asia/Manila');

    // $this->db->where('email_address',$email);
    // $query = $this->db->get('td_members',1);
    //
    // $member = $query->row();

    $this->db->where('member_id', $member_id);
    $deposit_query = $this->db->get('td_deposits');

    $total_growth = 0;

    foreach ($deposit_query->result() as $deposit) {
      if ($deposit->is_expired || $deposit->deposit_options_id != 11 || $deposit->is_pending == 1) {
        continue;
      } else {
        $start_date = new DateTime($deposit->date_approved);
        $end_date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

        $difference = $start_date->diff($end_date);
        // print_r($difference);
        $number_of_days = $difference->days;

        $this->db->where('id', $deposit->package_id);
        $package_query = $this->db->get('td_packages', 1);
        $package = $package_query->row();

        $package_growth = ($deposit->amount * ($package->daily_rate / 100)) * $number_of_days;

        $total_growth += $package_growth;
      }

      if ($member_id == '180') {
        return $total_growth + 261;
      }

    }

    return $total_growth;
  }

  public function Approve_pending($deposit_id)
  {

    date_default_timezone_set('Asia/Manila');

    $this->db->set('is_pending', '0');
    $this->db->set('date_approved', date('Y-m-d H:i:s'));
    $this->db->where('id', $deposit_id);
    $this->db->update('td_deposits');
  }

  public function get_all()
  {

    $query = $this->db->get('td_deposits');

    return $query->result();
  }

  public function delete_deposit($deposit_id)
  {
    $this->db->where('id', $deposit_id);
    $this->db->delete('td_deposits');
  }

  public function get_latest_deposit_amount($member_id)
  {
    $this->db->select('max(id), amount');
    $this->db->where('member_id', $member_id);
    $this->db->where('is_pending', 0);
    $query = $this->db->get('td_deposits');

    return $query->row();
  }

  public function get_latest_deposit($member_id)
  {
    $this->db->select('max(id)');
    $this->db->from('td_deposits');
    $this->db->where('member_id', $member_id);
    $sub_query = $this->db->get_compiled_select();

    $this->db->select("*");
    $this->db->from("td_deposits");
    $this->db->where("id = ($sub_query)");

    $query = $this->db->get();

    // print_r($query->row());
    return $query->row();

  }

  public function get_latest_approved($member_id)
  {
    $this->db->select('max(id)');
    $this->db->from('td_deposits');
    $this->db->where('member_id', $member_id);
    $this->db->where('date_approved is NOT NULL', NULL, FALSE);
    $sub_query = $this->db->get_compiled_select();

    $this->db->select("*");
    $this->db->from("td_deposits");
    $this->db->where("id = ($sub_query)");

    $query = $this->db->get();

    // print_r($query->row());
    return $query->row();

  }

  public function get_total_deposit($member_id)
  {
    $this->db->select_sum('amount');
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_deposits');

    return $query->row();
  }

  public function get_total_approved_deposit($member_id)
  {
    $this->db->select_sum('amount');
    $this->db->where('member_id', $member_id);
    $this->db->where('is_pending', 0);

    $query = $this->db->get('td_deposits');

    return $query->row();
  }

  public function get_member_reinvestment($member_id)
  {
    $this->db->where('member_id', $member_id);
    // $this->db->where('is_pending', 0);
    $this->db->where('deposit_options_id', 7);
    $query = $this->db->get('td_deposits');

    return $query->result();
  }

  public function get_total_member_reinvestment($member_id)
  {
    $this->db->select_sum('amount');
    $this->db->where('member_id', $member_id);
    // $this->db->where('is_pending', 0);
    $this->db->where('deposit_options_id', 1);
    $query = $this->db->get('td_deposits');

    return $query->row();
  }

  public function get_total_approved_deposit_per_member($member_id)
  {
    $total = 0;

    $this->db->select_sum('amount');
    $this->db->where('member_id', $member_id);
    $this->db->where('is_pending', 0);
    $query = $this->db->get('td_deposits');

    $total += $query->row()->amount;

    return $total;
  }

  public function get_pending_reinvestment($user_id)
  {
    $this->db->where('member_id', $user_id);
    $this->db->where('is_pending', 1);
    $this->db->where('deposit_options_id', 7);
    $query = $this->db->get('td_deposits');

    return $query->result();
  }

  public function get_deposits_last_2days($member_id)
  {
    $this->db->select("*, TIMESTAMPDIFF(HOUR, date_approved, now()) as hours_passed");
    $this->db->where('member_id', $member_id);
    $this->db->where('package_id !=', '1');
    $query = $this->db->get('td_deposits');

    return $query->result();
  }
}


?>