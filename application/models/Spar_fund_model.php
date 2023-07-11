<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spar_fund_model extends CI_Model
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
        $this->db->insert('td_spar_fund', $data);
    }


    public function update($data)
    {
        $this->db->set('member_id', $data['member_id']);
        $this->db->set('amount', $data['spar_amount']);
        $this->db->set('date', $data['spar_date']);
        $this->db->update('td_spar_fund');
    }


    public function get_per_member_id($member_id)
    {
        $this->db->where('member_id', $member_id);
        $query = $this->db->get('td_spar_fund');

        return $query->result();
    }


    public function get_all()
    {
        return $this->db->get('td_spar_fund')->result();
    }


    public function total_fund_per_member($member_id)
    {
        $this->db->where('member_id', $member_id);
        $query = $this->db->get('td_spar_fund');

        // print_r($query->result());


        $total_spar_fund = 0;
        foreach ($query->result() as $fund) {
            $total_spar_fund += $fund->amount;
        }
        // print_r($total_spar_fund);
        // print_r($this->db->last_query());
        // echo '<br>';

        return $total_spar_fund;
    }

    public function get_member_balance($member_id){
        $this->db->select_sum('amount');
        $this->db->where('member_id', $member_id);
        $query = $this->db->get('td_spar_fund');
        $total_received = $query->row()->amount;
        // $query->row()
        // print_r($query->row()->amount);

        $this->db->select_sum('amount');
        $this->db->where('recipient_id', $member_id);
        $query = $this->db->get('td_sparfund_transfer');
        $total_received += $query->row()->amount;

        $deductions = 0;
        // deductions from fund transfer
        $this->db->select_sum('amount');
        $this->db->where('sender_id', $member_id);
        $query = $this->db->get('td_sparfund_transfer');
        $deductions = $query->row()->amount;

        // deductions from sent remittance/gcash
        $this->db->select_sum('amount');
        $this->db->where('member_id', $member_id);
        $query = $this->db->get('td_remittance');
        $deductions += $query->row()->amount;

        return $total_received - $deductions;


    }



}