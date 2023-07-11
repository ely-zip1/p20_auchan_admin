<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral_bonus_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  public function add($bonus){
    $this->db->insert('td_referral_bonus', $bonus);
  }

  public function insert($bonus){
    $this->db->insert('td_referral_bonus', $bonus);
    $insert_id = $this->db->insert_id();

    return $insert_id;
  }

  public function get_per_member_id($member_id){
    $this->db->where('referrer_id', $member_id);
    $query = $this->db->get('td_referral_bonus');

    return $query->result();
  }

  public function get_total_bonus($referrer_id){

    $this->db->where('referrer_id', $referrer_id);
    $query = $this->db->get('td_referral_bonus');

    $total = 0.0;
    foreach($query->result() as $bonus){
      $total += $bonus->amount;
    }

    return $total;

  }
}