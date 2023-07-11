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
                        <h4>Pending Withdrawals</h4>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Amount Requested</th>
                                        <th>Payment Mode</th>
                                        <th>Clients's Email</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($withdrawal_data as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['client_name']; ?></td>
                                        <td>$ <?php echo $item['amount']; ?></td>
                                        <td><?php echo $item['mode']; ?></td>
                                        <td><?php echo $item['email']; ?></td>
                                        <td><?php
                                                $date=date_create($item['date']);
                                                echo date_format($date,"M d, Y h:i A"); ?></td>
                                        <td>

                                            <a tabindex="0" role="button" class="btn btn-info" data-toggle="popover"
                                                data-html="true" title="<?php echo $item['pop_over_title']; ?>"
                                                data-content="<?php echo $item['pop_over_text']; ?>">
                                                View
                                            </a>
                                            <!-- <a class='btn btn-info"
												href="<?php echo base_url('withdrawals_admin/view_withdrawal/'.$item['id'].'/'.$item['mode'].'/'.$item['member_id']) ?>"> View </a> -->
                                            <a class="btn btn-success"
                                                href="<?php echo base_url('withdrawals_admin/approve_withdrawal/'.$item['id']) ?>">
                                                Approve </a>
                                            <a class="btn btn-danger"
                                                href="<?php echo base_url('withdrawals_admin/delete_withdrawal/'.$item['id']) ?>">
                                                Delete </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
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