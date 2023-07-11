<?php

    class WithdrawalModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_withdrawal_per_member($member_id){
            $this->db->where('member_id',$member_id);
            $query = $this->db->get('td_withdrawals');

            return $query->result();
        }

        public function get_total_withdrawal_per_member($member_id){
          $this->db->select_sum('amount');
          $this->db->where('member_id',$member_id);
          $this->db->where('is_pending','0');
          $this->db->where('is_from_bonus','0');
          $query = $this->db->get('td_withdrawals');

          return $query->row();
        }

        public function get_bonus_withdrawal_per_member($member_id){
          $this->db->select_sum('amount');
          $this->db->where('member_id',$member_id);
          $this->db->where('is_pending','0');
          $this->db->where('is_from_bonus','1');
          $query = $this->db->get('td_withdrawals');

          return $query->row();
        }

        public function has_deposit($member_id){
            $this->db->where('member_id',$member_id);
            $query = $this->db->get('td_withdrawals',1);
            if($query->row()->amount > 0){
                return true;
            }else{
                return false;
            }
        }

        public function get_pending(){
            $this->db->where('is_pending','1');
            $query = $this->db->get('td_withdrawals');

            return $query->result();
        }

        public function get_approved(){
            $this->db->where('is_pending','0');
            $query = $this->db->get('td_withdrawals');

            return $query->result();
        }

        public function get_all(){
            $query = $this->db->get('td_withdrawals');

            return $query->result();
        }

        public function compute_total_withdrawn($member_id){

            $this->db->where('member_id',$member_id);
            $this->db->where('is_from_bonus',0);
            $this->db->where('is_pending',0);
            $withdrawn_query = $this->db->get('td_withdrawals');

            $total_withdrawn = 0;

            foreach($withdrawn_query->result() as $withdrawal){
                $total_withdrawn += $withdrawal->amount;
            }

            return $total_withdrawn;
        }

        public function add_new_withdrawal($withdrawal){

            $this->db->insert('td_withdrawals',$withdrawal);
        }

        public function delete_withdrawal($withdrawal_id){

            $this->db->where('id', $withdrawal_id);
            $this->db->delete('td_withdrawals');
        }

        public function Approve_pending($withdrawal_id){

            date_default_timezone_set('Asia/Manila');

            $this->db->set('is_pending', '0');
            $this->db->set('date_approved', date('Y-m-d H:i:s'));
            $this->db->where('id', $withdrawal_id);
            $this->db->update('td_withdrawals');
        }

        public function get_pending_withdrawal($member_id){
          $query = $this->db->query('SELECT sum(amount) as total FROM `td_withdrawals`
          WHERE member_id = '.$member_id.' and is_pending = 1');

          return $query->row();
        }

        public function get_latest_withdrawal_amount($member_id){
          $this->db->select('max(id), amount');
          $this->db->where('member_id', $member_id);
          $this->db->where('is_pending', 0);
          $query = $this->db->get('td_withdrawals');

          return $query->row();
        }
    }


?>