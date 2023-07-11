<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-2">
                    <div class="card card-success">
                        <div class="card-header">
                            <h4>Withdrawal</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p>Minimum Amount</p>
                                </div>

                                <div class="col-6 text-right">
                                    <p><strong> $5</strong></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <p>Total Profit (Withdrawable)</p>
                                </div>

                                <div class="col-6 text-right">
                                    <p><strong> $<?php if(isset($total_profit))echo $total_profit;?></strong></p>
                                </div>

                            </div>
                            <?php echo form_open('Withdrawals');?>

                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="withdraw_amount">Withdrawal Amount</label>
                                    <input id="withdraw_amount" type="text"
                                        value="<?= set_value('withdraw_amount','',true)?>"
                                        class="text-right form-control <?php if(strlen(form_error('withdraw_amount')) > 0){echo "is-invalid";} ?>"
                                        name="withdraw_amount" autofocus />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('withdraw_amount');?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">
                                    <span class="fas fa-plus"></span>
                                    Request Withdrawal
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="login-brand">
                        <h4>Your Withdrawals</h4>
                    </div>
                    <div class="card card-primary">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Payment Mode</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Requested</th>
                                        <th scope="col">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($withdrawal_data as $row): array_map('htmlentities', $row); ?>
                                    <tr>
                                        <td><?php echo implode('</td><td>', $row); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="footer"> </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>