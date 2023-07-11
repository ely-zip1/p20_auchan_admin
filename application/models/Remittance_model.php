<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remittance_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
  }

  public function add($data){
    $this->db->insert('td_remittance',$data);
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_remittance');

    return $query->result();
  }

  public function get_incomplete(){
    $this->db->where('is_complete', '0');
    $query = $this->db->get('td_remittance');

    return $query->result();
  }

  public function mark_complete($ref_code){
    $this->db->set('is_complete', '1');
    $this->db->where('reference', $ref_code);
    $this->db->update('td_remittance');
  }
}