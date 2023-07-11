<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Remittance Requests</h4>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Mode</th>
                                        <th>Amount</th>
                                        <th>USD/PHP</th>
                                        <th>Send to</th>
                                        <th>Bank</th>
                                        <th>Bank Code</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($request_data as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['member']; ?></td>
                                        <td><?php echo $item['mode']; ?></td>
                                        <td>$<?php echo $item['amount']; ?></td>
                                        <td>PHP <?php echo $item['rate']; ?></td>
                                        <td><?php echo $item['recipient']; ?></td>
                                        <td><?php echo $item['bank_name']; ?></td>
                                        <td><?php echo $item['bank_code']; ?></td>
                                        <td><?php echo $item['phone']; ?></td>
                                        <td><?php echo $item['country']; ?></td>
                                        <td><?php echo $item['address']; ?></td>
                                        <td><?php echo $item['date']; ?></td>
                                        <td><?php echo $item['ref_code']; ?></td>
                                        <td>
                                            <?php echo form_open('remittance_admin/complete'); ?>
                                            <input type="text" value="<?= $item['ref_code'] ?>" style="display:none"
                                                name="ref_code" id="ref_code">

                                            <button type="submit" class="btn btn-success">
                                                Complete </button>

                                            <?php echo form_close();?>
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