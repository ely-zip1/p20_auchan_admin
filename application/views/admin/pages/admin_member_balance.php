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
                        <h4>Member Balance</h4>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($balance_data as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['client_name']; ?></td>
                                        <td><?php echo $item['email']; ?></td>
                                        <td>$ <?php echo $item['balance']; ?></td>
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