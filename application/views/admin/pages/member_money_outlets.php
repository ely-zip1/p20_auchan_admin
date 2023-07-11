<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <!-- <?php print_r($deposit_data);?> -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Member Accounts</h4>
                    </div>
                    <div class="card card-info">
                        <div class="card-body">
                            <?php
                            if(!empty($bank_name)){
                            ?>
                            <h3>Bank</h3> <br>
                            <strong>Bank Name: </strong> <?=$bank_name?><br>
                            <strong>Account Name: </strong> <?=$bank_account_name?><br>
                            <strong>Account Number: </strong> <?=$bank_account_number?><br>
                            <strong>Bank Code: </strong> <?=$bank_code?><br><br>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($bitcoin_account)){
                            ?>
                            <h3>Bitcoin</h3> <br>
                            <strong>BTC Account: </strong> <?=$bitcoin_account?><br>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($ethereum_account)){
                            ?>
                            <h3>Ethereum</h3> <br>
                            <strong>ETH Account: </strong> <?=$ethereum_account?><br>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($dog_account)){
                            ?>
                            <h3>Doge</h3> <br>
                            <strong>Doge Account: </strong> <?=$dog_account?><br>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($ripple_account)){
                            ?>
                            <h3>Ripple</h3> <br>
                            <strong>Ripple Account: </strong> <?=$ripple_account?><br>
                            <strong>Ripple Tag: </strong> <?=$ripple_tag?><br>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($tron_account)){
                            ?>
                            <h3>Tron</h3> <br>
                            <strong>TRX Account: </strong> <?=$tron_account?><br>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($litecoin_account)){
                            ?>
                            <h3>Litecoin</h3> <br>
                            <strong>LTC Account: </strong> <?=$litecoin_account?><br>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="footer"> </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>