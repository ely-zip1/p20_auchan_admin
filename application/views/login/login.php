<?php
$this->load->view('login/login-header');

// $currencies = file_get_contents('https://api.currencyfreaks.com/v2.0/rates/latest?apikey=bddfe5b54bdb4bb2a60dedf37b09cc63');

// $the_json = json_decode($currencies);

// print_r($the_json->rates->PHP);

?>

<section class="login_section">
    <div class="login_form">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card login_card">
                    <div class="card-body login_card_body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="login-brand">
                                    <div class="logo-container">
                                        <a href="<?= base_url(); ?>">
                                            <div class="brand-logo"></div>
                                        </a>
                                    </div>
                                    <br>
                                    <br>
                                    <span class="brand-group">MEMBER LOGIN</span>
                                </div>
                            </div>
                        </div>

                        <?php
                        if ($this->session->flashdata('reg_status') == "success") {
                            ?>
                        <div class="alert spar-alert-success alert-has-icon">
                            <div class="alert-icon"><i class="far fa-check-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title">Congratulations!</div>
                                Your account is ready. Please login.
                            </div>
                        </div>

                        <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-12 text-center">
                                <!-- <h3 class="login-title"> Login</h3> -->
                            </div>
                        </div>

                        <?php

                        if (isset($validation_error)) {
                            echo '<div class="alert alert-danger">';
                            echo $validation_error;
                            echo '</div>';
                        }

                        ?>
                        <!-- <form method="POST" action="#" class="needs-validation" novalidate=""> -->
                        <?php echo form_open('login'); ?>
                        <div class="form-group">
                            <label for="username" class="log_reg_label">Username:</label>
                            <input id="username" type="text" class="form-control login_input <?php if (strlen(form_error('username')) > 0) {
                                echo "is-invalid";
                            } ?>" name="username" tabindex="1" autofocus value="<?= set_value('username', '', true) ?>"
                                required>
                            <div class="invalid-feedback">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label log_reg_label">Password:</label>

                            </div>
                            <input id="password" type="password" class="form-control login_input <?php if (strlen(form_error('password')) > 0) {
                                echo "is-invalid";
                            } ?>" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                <?php echo form_error('password'); ?>
                            </div>
                            <!-- <div class="float-right">
                                    <a href="<?php echo base_url(); ?>forgot_password"
                                        class="text-small forgot_password">
                                        Forgot Password?
                                    </a>
                                </div> -->
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-lg btn-block spar-red-btn" tabindex="4">
                                Login
                            </button>
                        </div>
                        </form>
                        <div class="mb-3 text-center">
                            <!-- <span class="create_account">Create an account. </span> -->
                            <!-- Don't have an account? -->
                            <a class="sign_up" href="<?php echo base_url(); ?>registration">
                                Sign up
                            </a>
                        </div>
                        <div class="mb-3 text-center">
                            <a href="<?php echo base_url(); ?>forgot_password" class="forgot_password">
                                Forgot Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$this->load->view('login/login-footer');
?>