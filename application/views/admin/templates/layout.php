<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg navbar-bg-admin"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </form>
            <div class="mr-auto"></div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
                        <!-- <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1 "> -->
                        <h3 class="fas fa-user"></h3>
                        <div class="d-sm-none d-lg-inline-block">
                            <?php echo ucfirst($this->session->first_name) . ' ' . ucfirst($this->session->last_name) ; ?>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow">
                        <a href="#" class="dropdown-item has-icon">
                            <i class="fas fa-at"></i> <?php echo $this->session->email; ?>
                        </a>
                        <a href="<?=base_url();?>logout" class="dropdown-item has-icon">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>