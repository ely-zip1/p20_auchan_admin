<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spar_fund_transfer_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //
    }

    public function add($data)
    {
        $this->db->insert('td_sparfund_transfer', $data);
    }

    public function get_sent($sender_id){
        $this->db->where('sender_id', $sender_id);
        $query = $this->db->get('td_sparfund_transfer');

        return $query->result();
    }

    public function get_received($recipient_id){
        $this->db->where('recipient_id', $recipient_id);
        $query = $this->db->get('td_sparfund_transfer');

        return $query->result();
    }



}