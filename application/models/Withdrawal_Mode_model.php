<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal_Mode_model extends CI_Model {

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

  public function add($data){
      $this->db->insert('td_withdrawal_mode',$data);
  }

  public function get_all(){
    $query = $this->db->get('td_withdrawal_mode');
    return $query->result();
  }

  public function get_by_id($id){
    $this->db->where('id',$id);
    $query = $this->db->get('td_withdrawal_mode',1);
    return $query->row();
  }

  public function get_per_member($member_id){
    $this->db->where('member_id',$member_id);
    $query = $this->db->get('td_withdrawal_mode');
    return $query->row();
  }

  public function update_bitcoin($member_id, $bitcoin){
    $this->db->set('bitcoin', $bitcoin);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_ethereum($member_id, $ethereum){
    $this->db->set('ethereum', $ethereum);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_bitcoincash($member_id, $bitcoincash){
    $this->db->set('bitcoin_cash', $bitcoincash);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_stellar($member_id, $stellar){
    $this->db->set('stellar', $stellar);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_ripple($member_id, $ripple_account, $ripple_tag){
    $this->db->set('xrp_account', $ripple_account);
    $this->db->set('xrp_tag', $ripple_tag);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_tron($member_id, $tron){
    $this->db->set('trx', $tron);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_ltc($member_id, $ltc){
    $this->db->set('litecoin', $ltc);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }

  public function update_doge($member_id, $doge){
    $this->db->set('doge_coin', $doge);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }
  public function update_usdt($member_id, $usdt){
    $this->db->set('usdt', $usdt);
    $this->db->where('member_id', $member_id);
    $this->db->update('td_withdrawal_mode');
  }
}