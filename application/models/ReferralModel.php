<?php

    class ReferralModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_all(){
            $query = $this->db->get('td_referrals');

            return $query->result();
        }

        public function get_referrer($member_id){
            $this->db->where('referee_id', $member_id);
            $query = $this->db->get('td_referrals');

            return $query->row();
        }

        public function get_referees($referrer_id){
            $this->db->where('referrer_id', $referrer_id);
            $query = $this->db->get('td_referrals');

            return $query->result();
        }

        public function add_referral($referral_array){

            $this->db->insert('td_referrals',$referral_array);
        }

        public function set_referral_bonus($referee_id, $referral_bonus){

            $this->db->set('referral_bonus', $referral_bonus);
            $this->db->where('referee_id', $referee_id);
            $this->db->update('td_referrals');
        }

        public function count_referrals($member_id){
          $this->db->where('referrer_id ', $member_id);
          $this->db->from('td_referrals');
          $query = $this->db->count_all_results();

          return $query;
        }
    }


?>
