<div class="main-content">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Advanced Withdrawal Requests</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">

                            <?php echo form_open('admin_loan') ?>
                            <div class="form-group">
                                <div class="input-group">
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
                            <!-- <?php

                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        echo '<li class="page-item">
								<a class="page-link" href="' . base_url('manage_users/' . $i * 10) . '">' . $i . '</a></li>';
                                    } ?> -->

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
                                        <th>Deposit</th>
                                        <th>Amount Applied</th>
                                        <th>E-Money</th>
                                        <th>Date Applied</th>
                                        <th>Action</th>
                                        <th>Mode</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($aw_requests as $request) { ?>
                                    <tr>
                                        <td><?php echo $request['name']; ?></td>
                                        <td><?php echo $request['email']; ?></td>
                                        <td>$<?php echo number_format($request['deposit'], 2); ?></td>
                                        <td>$<?php echo number_format($request['amount_applied'], 2); ?></td>
                                        <td>$<?php echo number_format($request['e_money'], 2); ?></td>
                                        <td><?php echo $request['date']; ?></td>
                                        <td>
                                            <a class="btn btn-danger btn-sm"
                                                href="<?php echo base_url('admin_loan/delete/' . $request['request_id']) ?>">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <a class="btn btn-success btn-sm"
                                                href="<?php echo base_url('admin_loan/approve/' . $request['request_id']) ?>">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?=base_url('member_outlet/' . $request['member_id']) ?>"
                                                class="btn btn-info btn-sm">i</a>
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