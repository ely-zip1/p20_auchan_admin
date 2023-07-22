<?php

class Daily_income_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();

    date_default_timezone_set('Asia/Manila');
  }

  public function add($deposit)
  {
    $this->db->insert('td_daily_income', $deposit);
  }

  public function get_per_member($member_id)
  {
    $this->db->order_by('date_added', 'DESC');
    $this->db->where('member_id', $member_id);
    $this->db->where('date_added <= NOW()');
    $query = $this->db->get('td_daily_income');

    return $query->result();
  }

  public function get_per_deposit($deposit_id)
  {
    $this->db->where('deposit_id', $deposit_id);
    $query = $this->db->get('td_daily_income');

    return $query->result();
  }

  public function total_income_today($member_id)
  {
    // $this->db->where('date(date_added)', 'CURDATE()');
    // $query = $this->db->get('td_daily_income');
    $query = $this->db->query('select sum(amount) as todays_income from td_daily_income where member_id = ' . $member_id . ' and date(date_added) = CURDATE()');
    return $query->row();
  }

  public function create_event($qry)
  {
    $this->db->query($qry);
  }

  public function generate_daily_income($deposit, $duration, $rate)
  {
    $amount = $deposit->amount * ($rate / 100);
    $temp_date = new DateTime($deposit->date_approved);

    while ($duration > 0) {
      $income = array(
        'id' => null,
        'amount' => $amount,
        'date_added' => $temp_date->modify('+1 day')->format('Y-m-d H:i:s'),
        'member_id' => $deposit->member_id,
        'deposit_id' => $deposit->id
      );

      $this->db->insert('td_daily_income', $income);

      $duration--;
    }

    // if ($duration == 0) {
    //   return true;
    // } else {
    //   return false;
    // }
  }

  public function total_growth($member_id)
  {
    $this->db->select_sum('amount');
    $this->db->where('member_id', $member_id);
    $this->db->where('date_added <=', date('Y-m-d H:i:s'));
    $query = $this->db->get('td_daily_income');

    return $query->row()->amount;
  }

  public function fix_error()
  {
    // $data = array(
    //   'amount' => '300'
    // );

    // $this->db->where('amount', '400');
    // $this->db->replace('td_daily_income', $data);

    $this->db->set('amount', '1.8');
    $this->db->where('amount', '2');
    $this->db->where('deposit_id', '120');
    $this->db->update('td_daily_income');

    $this->db->set('amount', '300');
    $this->db->where('amount', '400');
    $this->db->where('deposit_id', '119');
    $this->db->update('td_daily_income');
  }
}