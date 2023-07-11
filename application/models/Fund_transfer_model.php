<?php

    class Fund_transfer_model extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function received_per_member($member_id){
          $this->db->where('receiver_member_id', $member_id);
          $query = $this->db->get('td_fund_transfer');

          return $query->result();
        }

        public function sent_per_member($member_id)
        {
          $this->db->where('sender_member_id', $member_id);
          $query = $this->db->get('td_fund_transfer');

          return $query->result();
        }

        public function add($transfer_data)
        {
          // print_r($transfer_data);
          $this->db->insert('td_fund_transfer', $transfer_data);
        }

        public function get_total_received($member_id){
          $this->db->select_sum('amount');
          $this->db->where('receiver_member_id', $member_id);
          $query = $this->db->get('td_fund_transfer');

          return $query->row()->amount;
        }

        public function get_total_sent($member_id){
          $this->db->select_sum('amount');
          $this->db->where('sender_member_id', $member_id);
          $query = $this->db->get('td_fund_transfer');

          return $query->row()->amount;
        }

        public function get_all(){
          $query = $this->db->get('td_fund_transfer');

          return $query->result();
        }
    }
