<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Account Balance Transfer History</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <div class="card-header">
              	<h4>RECEIVED FUNDS</h4>
              </div> -->
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Sender</th>
                                            <th scope="col">Receiver</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        <?php
  									if(isset($fund_transfer_history)){
  									foreach ($fund_transfer_history as $row){?>
                                        <tr>
                                            <td>$ <?php echo $row['amount']; ?></td>
                                            <td><?php echo $row['sender']; ?></td>
                                            <td><?php echo $row['receiver']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>