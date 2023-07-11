<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg navbar-bg-custom"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <div class="mr-auto"></div>
        <div class="navbar-nav navbar-right">
          <!-- <a href="<?php echo base_url(); ?>" class="btn btn-icon icon-left rounded-button header-button-1"><i class="fas fa-user"></i> CASH FLOW</a>
          <span class="nav-spacer"> </span>
          <a href="<?php echo base_url('logout'); ?>" class="btn btn-icon icon-left rounded-button header-button-2"><i class="fas fa-sign-out-alt"></i> LOGOUT</a> -->
          <li class="media">
            <!-- <img alt="image" class="mr-3 rounded-circle" width="40" src="assets/img/avatar/avatar-3.png"> -->
            <div class="media-body">
              <div class="media-title"><span class="username"><?php echo ucwords($this->session->fullname, ' '); ?></span></div>
              <div class="text-job  nav-welcome nav-country">
                <img src="<?php echo base_url()."assets/img/country_flag/".$this->session->flag; ?>" alt="flag">
                <?php echo $this->session->country; ?>
              </div>
            </div>
          </li>
        </div>
      </nav>
