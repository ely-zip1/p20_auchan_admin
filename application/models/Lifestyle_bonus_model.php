<?php

    class Lifestyle_bonus_model extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function add($bonus_data){
            $this->db->insert('td_lifestyle_bonus', $bonus_data);
        }
        
        public function get_total_bonus($member_id){
            $this->db->where('member_id',$member_id);
            $query = $this->db->get('td_lifestyle_bonus');

            return $query->result();
        }

        public function total_fund_bonus($member_id){
            $this->db->where('member_id',$member_id);
            $bonus_query = $this->db->get('td_lifestyle_bonus');

            $total_bonus = 0;

            foreach($bonus_query->result() as $bonus){
                $total_bonus += $bonus->amount;
            }

            return $total_bonus;
        }

    }