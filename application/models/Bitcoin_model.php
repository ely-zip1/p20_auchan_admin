<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Bitcoin_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Bitcoin_model extends CI_Model {

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


  public function add($data){
    $this->db->insert('td_btc',$data);
  }

  public function update($data){
    $this->db->set('address', $data['address']);
    $this->db->where('member_id', $data['member_id']);
    $this->db->update('td_btc');
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_btc', 1);

    return $query->row();
  }

  public function has_account($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_btc', 1);

    if($query->row() != null){
      return true;
    }else{
      return false;
    }
  }
}

/* End of file Bitcoin_model.php */
/* Location: ./application/models/Bitcoin_model.php */