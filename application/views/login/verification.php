<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>

    <style>
    .card {
        box-shadow: 3px 3px 20px #aaa;
        background: #4d9ad2;
        color: #fff;
    }

    .verification-btn {
        background-color: #FFBE1E;
        color: #000;
        width: 100px;
        padding: 5px;
        box-shadow: 0px 3px 2px #555;
    }

    .verification-btn:hover {
        background-color: #FFBE1E !important;
        color: #fff !important;
    }
    </style>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="login-brand">
                                </div>
                            </div>
                        </div>

                        <div class="card verify_card">
                            <div class="card-body text-center">
                                <div class="row text-center">
                                    <div class="col-12">

                                        <h1 class="reg_success">Registration Successful!</h1>

                                        <!-- <h5 style="color: white;">Proceed to your dashboard.</h5> -->
                                        <a href="<?php echo base_url();?>logout"
                                            class="btn btn-large verification-btn">Login</a>


                                        <!-- <h6>Almost there!</h6> <br>
                                 <h6>Enter the code that we have sent to your email to activate your account.</h6>
                                 <br>

                                 <?php echo form_open('verification'); ?>
                                 <div class="form-group">
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="" aria-label="" name="v_code">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary" type="submit">Confirm</button>
                                    </div>
                                  </div>
                                </div>
                                <?php  echo form_close(); ?> -->

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="simple-footer">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>