<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>


<!-- new method Modal -->
<div class="modal fade" id="newWithdrawalMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Withdrawal Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="methodName" class="col-sm-4 col-form-label">Enter method name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="methodName" placeholder="Enter method name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="minAmount" class="col-sm-4 col-form-label">Minimum Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="minAmount" placeholder="Minimum amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maxAmount" class="col-sm-4 col-form-label">Maximum Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="maxAmount" placeholder="Maximum amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chargeFixed" class="col-sm-4 col-form-label">Charges(Fixed Amt)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="chargeFixed" placeholder="Fixed charge">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chargePercent" class="col-sm-4 col-form-label">Charges(Percentage)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="chargePercent" placeholder="Percentage charge">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="duration" class="col-sm-4 col-form-label">Duration</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="duration" placeholder="Duration">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" id="status">
                                <option>Enabled</option>
                                <option>Disabled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="new_withdrawal_submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- update method Modal -->
<div class="modal fade" id="newWithdrawalMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Withdrawal Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="methodName" class="col-sm-4 col-form-label">Enter method name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="methodName" placeholder="Enter method name"
                            value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="minAmount" class="col-sm-4 col-form-label">Minimum Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="minAmount" placeholder="Minimum amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maxAmount" class="col-sm-4 col-form-label">Maximum Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="maxAmount" placeholder="Maximum amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chargeFixed" class="col-sm-4 col-form-label">Charges(Fixed Amt)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="chargeFixed" placeholder="Fixed charge">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chargePercent" class="col-sm-4 col-form-label">Charges(Percentage)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="chargePercent" placeholder="Percentage charge">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="duration" class="col-sm-4 col-form-label">Duration</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="duration" placeholder="Duration">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" id="status">
                                <option>Enabled</option>
                                <option>Disabled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="edit_withdrawal_submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            Site Settings
        </div>

        <div class="section-body">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Payment Methods</h4>
                            </div>

                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="section-title mt-0">Cryptocurrencies</div>
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                                <label>Bitcoin Address</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="btc_address" value="<?php if (isset($btc)){ echo $btc;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Ethereum Address</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="eth_address" value="<?php if (isset($eth)){ echo $eth;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Bitcoin Cash Address</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="bch_address" value="<?php if (isset($bch)){ echo $bch;} ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section-title mt-10">Bank Transfer</div>
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <input type="text" class="form-control form-control-sm" name="bank_name"
                                                    value="<?php if (isset($bank_name)){ echo $bank_name;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Account name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="bank_account_name"
                                                    value="<?php if (isset($bank_account_name)){ echo $bank_account_name;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Account number</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="bank_account_number"
                                                    value="<?php if (isset($bank_account_number)){ echo $bank_account_number;} ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="section-title mt-10">GCash</div>
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                                <label>GCash account number</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="gcash_account"
                                                    value="<?php if (isset($gcash_account)){ echo $gcash_account;} ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section-title mt-0">PayPal</div>
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                                <label>PayPal Address</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="paypal_address"
                                                    value="<?php if (isset($paypal_address)){ echo $paypal_address;} ?>">
                                            </div>

                                            <div class="text-right">
                                                <button class="btn btn-primary mr-1 btn-sm" type="submit"
                                                    name="payment_options_submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>


                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Withdrawal Methods</h4>
                            </div>

                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#newWithdrawalMethodModal">
                                    Launch demo modal
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
</div>