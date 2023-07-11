<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indirect_bonus_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  // ------------------------------------------------------------------------

  public function add($bonus){
    $this->db->insert('td_indirect_bonus', $bonus);
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_indirect_bonus');

    return $query->result();
  }

  public function get_total_bonus($member_id){

    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_indirect_bonus');

    $total = 0.0;
    foreach($query->result() as $bonus){
      $total += $bonus->amount;
    }

    return $total;

  }
}
