<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Client's Messages</h4>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm messages_table">


                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Date Created</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($message_data as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['client_name']; ?></td>
                                        <td><?php echo $item['email']; ?></td>
                                        <td><?php
                                                $date=date_create($item['date']);
                                                echo date_format($date,"M d, Y h:i A"); ?></td>
                                        <td><?php echo $item['message']; ?></td>
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