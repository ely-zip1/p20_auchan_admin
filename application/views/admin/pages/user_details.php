<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User Details</h1>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h5>Personal Details</h5>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Date Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $member_data['name']; ?></td>
                                        <td>$ <?php echo $member_data['email']; ?></td>
                                        <td><?php echo $member_data['date']; ?></td>

                                    </tr>
                                </tbody>

                            </table>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="login-brand">
                        <h5>Deposit Details</h5>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Mode</th>
                                        <th>Status</th>
                                        <th>Is Expired</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($deposit as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['package']; ?></td>
                                        <td>$ <?php echo $item['amount']; ?></td>
                                        <td><?php echo $item['mode']; ?></td>
                                        <td><?php echo $item['pending']; ?></td>
                                        <td><?php echo $item['expired']; ?></td>

                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="login-brand">
                        <h5>Withdrawal Details</h5>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Date Requested</th>
                                        <th>Date Approved</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($withdrawals as $withdrawal) { ?>
                                    <tr>
                                        <td>$ <?php echo $withdrawal['amount']; ?></td>
                                        <td><?php echo $withdrawal['method']; ?></td>
                                        <td><?php echo $withdrawal['request_date']; ?></td>
                                        <td><?php echo $withdrawal['approve_date']; ?></td>
                                        <td><?php echo $withdrawal['pending']; ?></td>

                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="login-brand">
                        <h5>Referral Details</h5>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email address</th>
                                        <th>Date Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($referrals as $referral) { ?>
                                    <tr>
                                        <td><?php echo $referral['name']; ?></td>
                                        <td><?php echo $referral['email']; ?></td>
                                        <td><?php echo $referral['date']; ?></td>

                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>


                        </div>
                    </div>
                </div>
            </div>


        </div>
</div>
</section>
</div>