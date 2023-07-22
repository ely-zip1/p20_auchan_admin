<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
            <h1>Update Account</h1>
        </div> -->
        <div class="container mt-5">
            <!-- <?php print_r($deposit_data); ?> -->
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Send Package to Member</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">

                            <?php echo form_open('manage_users') ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="search-term" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn text-dark" type="submit">Search</button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn text-dark" value="cancel" name="cancel"
                                            type="submit">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>

                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered table-sm">


                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    foreach ($members_list as $member) {
                                        ?>

                                        <tr>
                                            <?= form_open('send_package/' . $member->id) ?>

                                            <td><?= $member->full_name; ?> &mdash;&mdash; <?= $member->username; ?></td>
                                            <!-- <td><?= $member->email_address; ?></td> -->
                                            <td>
                                                <select name="package" class="rounded border px-2 py-2">
                                                    <option value="1">Economy</option>
                                                    <option value="2">Business</option>
                                                    <option value="3">Luxury</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="amount<?= $member->id ?>" min="250"
                                                    class="rounded py-2 px-2 <?= !empty(form_error('amount' . $member->id)) ? 'border-red-500 border-2' : '' ?>"
                                                    placeholder="€">

                                                <!-- <div class="invalid-feedback text-red-500 text-xs">
                                                    <?php echo form_error('amount') ?>
                                                </div> -->
                                            </td>
                                            <td>
                                                <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded">
                                                    Send Package
                                                </button>
                                            </td>

                                            <?= form_close(); ?>
                                        </tr>

                                        <?php
                                    }
                                    ?>
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