<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2 shadow sidebar">
    <aside id="sidebar-wrapper">

        <div class="sidebar-brand">
            <a href="<?= base_url('deposits_admin'); ?>">Auchan Retail</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('deposits_admin'); ?>">AR</a>
        </div>

        <ul class="sidebar-menu">

            <li class="dropdown <?php echo $this->uri->segment(1) == 'deposits_admin' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>deposits_admin" class="nav-link"><i class="far fa-clock"></i><span>Pending
                        Deposits</span></a>
            </li>
            <li class="dropdown <?php echo $this->uri->segment(1) == 'approved_deposits' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>approved_deposits" class="nav-link"><i
                        class="far fa-check-circle"></i><span>Approved Deposits</span></a>
            </li>

            <li class="dropdown <?php echo $this->uri->segment(1) == 'withdrawals_admin' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>withdrawals_admin" class="nav-link"><i
                        class="fas fa-clock"></i><span>Pending
                        Withdrawals</span></a>
            </li>
            <li class="dropdown <?php echo $this->uri->segment(1) == 'approved_withdrawals' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>approved_withdrawals" class="nav-link"><i
                        class="fas fa-check-circle"></i><span>Approved Withdrawals</span></a>
            </li>

            <li class="dropdown <?php echo $this->uri->segment(1) == 'manage_users' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>manage_users" class="nav-link"><i class="fas fa-users-cog"></i><span>Manage
                        Users</span></a>
            </li>

            <li
                class="dropdown <?php echo $this->uri->segment(1) == 'fund_transfer_admin' || $this->uri->segment(1) == 'fund_transfer_admin_actfund' ? 'active' : ''; ?>">
                <a href="<?= base_url(); ?>fund_transfer_admin" class="nav-link"><i
                        class="fas fa-exchange-alt"></i><span>Transferred Funds</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo $this->uri->segment(1) == 'fund_transfer_admin' ? 'active' : ''; ?>"><a
                            class="nav-link" href="<?php echo base_url(); ?>fund_transfer_admin">Account Balance</a>
                    </li>
                    <li class="<?php echo $this->uri->segment(1) == 'fund_transfer_admin_actfund' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo base_url(); ?>fund_transfer_admin_actfund">Activation
                            Fund</a>
                    </li>
                </ul>
            </li>

            <!-- <li class="dropdown <?php echo $this->uri->segment(1) == 'group_sales_admin' ? 'active' : ''; ?>">
                <a href="<?= base_url(); ?>group_sales_admin" class="nav-link"><i class="fas fa-award"></i><span>Monthly
                        Bonus</span></a>
            </li> -->

            <li class="dropdown <?php echo $this->uri->segment(1) == 'messages_admin' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>messages_admin" class="nav-link"><i
                        class="far fa-envelope"></i><span>Messages</span></a>
            </li>

            <!-- <li class="dropdown <?php echo $this->uri->segment(1) == 'admin_loan' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>admin_loan" class="nav-link"><i
                        class="fas fa-business-time"></i><span>Advanced
                        Withdrawals</span></a>
            </li> -->

            <!-- <li class="dropdown <?php echo $this->uri->segment(1) == 'activation_fund_admin' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>activation_fund_admin" class="nav-link"><i class="fas fa-bolt"></i><span>
                        USD Wallet</span></a>
            </li>

            <li class="dropdown <?php echo $this->uri->segment(1) == 'spar_fund_admin' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>spar_fund_admin" class="nav-link"><i
                        class="fas fa-money-bill-wave"></i><span>
                        SPAR Funds</span></a>
            </li> -->

            <li class="dropdown <?php echo $this->uri->segment(1) == 'remittance_admin' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>remittance_admin" class="nav-link"><i class="fas fa-share-alt"></i><span>
                        Remittance Requests </span></a>
            </li>

            <li class="dropdown <?php echo $this->uri->segment(1) == 'Admin_member_balance' ? 'active' : ''; ?>"> <a
                    href="<?= base_url(); ?>Admin_member_balance" class="nav-link"><i
                        class="fas fa-hand-holding-usd"></i><span>
                        Member Balance</span></a>
            </li>
            <br>
            <br>
            <br>


        </ul>
    </aside>
</div>