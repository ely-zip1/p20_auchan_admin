<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Registered Users</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">

                            <?php echo form_open('manage_users') ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <!-- <select class="custom-select" id="inputGroupSelect05" name="filter">
	                    <option selected value="name">Name</option>
	                    <option value="username">Username</option>
	                  </select> -->
                                    <input type="text" name="search-term" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" value="cancel" name="cancel"
                                            type="submit">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>

                        </div>
                    </div>
                    <div class="">
                        <ul class="pagination">
                            <?php

								// print_r($total_pages);

							for ($i=1; $i <= $total_pages; $i++) {
								echo '<li class="page-item">
								<a class="page-link" href="'.base_url('manage_users/'.$i*10).'">'.$i.'</a></li>';
							} ?>

                        </ul>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <!-- <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav> -->
                            <table class="table table-hover table-bordered table-sm">

                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Total Deposit</th>
                                        <th>Date Joined</th>
                                        <th>Referred By</th>
                                        <th>Referral Code</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td><?php echo $user['full_name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td>$ <?php echo number_format($user['total_deposit'],2); ?></td>
                                        <td><?php echo $user['date_joined']; ?></td>
                                        <td><?php echo $user['referred_by']; ?></td>
                                        <td><?php echo base_url().'my/ref/'.$user['referral_code']; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="<?php echo base_url('user_details/show/'.$user['id']) ?>"> Details
                                            </a>
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