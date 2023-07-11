<?php
$this->load->view('login/login-header');

?>
<section class="login_section">
    <div class="login_form">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card login_card">


                    <div class="card-body login_card_body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="login-brand">
                                    <a href="<?= base_url(); ?>">
                                        <img src="<?= base_url(); ?>assets/img/arco-logo.svg" alt="logo">
                                    </a>
                                    <br>
                                    <br>
                                    <span class="brand-group">Verification</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="">Please provide the code sent to your email.</span>
                            </div>
                        </div>

                        <?php
                            if ($this->session->flashdata('error') != null) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    Invalid code.
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                            ?>

                        <!-- <form method="POST" action="#" class="needs-validation" novalidate=""> -->
                        <?php echo form_open('authorize'); ?>
                        <div class="form-group">
                            <label for="auth_code" class="log_reg_label">Code:</label>
                            <input id="auth_code logreg_input" type="text" class="form-control <?php if (strlen(form_error('auth_code')) > 0) {
                                                                                                        echo "is-invalid";
                                                                                                    } ?>"
                                name="auth_code" tabindex="1" autofocus value="<?= set_value('auth_code', '', true) ?>"
                                required>
                            <div class="invalid-feedback">
                                <?php echo form_error('auth_code'); ?>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-lg btn-block btn_login" tabindex="4">
                                Continue
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->load->view('login/login-footer');

?>