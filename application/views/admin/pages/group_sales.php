<div class="main-content">
    <section class="section">
        <!-- <div class="section-header">
			<h1>Update Account</h1>
		</div> -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="section-header section_header_admin">
                        <h4>Group Sales</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?=form_open('group_sales_admin');?>
                                            <div class="form-group">
                                                <label for="month-selector">Month</label>
                                                <div class="input-group">
                                                    <select class="custom-select" id="inputGroupSelect04"
                                                        name="selected_month">
                                                        <option value="01"
                                                            <?php if($selected_month == '01') echo 'selected';?>>
                                                            January
                                                        </option>
                                                        <option value="02"
                                                            <?php if($selected_month == '02') echo 'selected';?>>
                                                            February
                                                        </option>
                                                        <option value="03"
                                                            <?php if($selected_month == '03') echo 'selected';?>>
                                                            March
                                                        </option>
                                                        <option value="04"
                                                            <?php if($selected_month == '04') echo 'selected';?>>
                                                            April
                                                        </option>
                                                        <option value="05"
                                                            <?php if($selected_month == '05') echo 'selected';?>>
                                                            May
                                                        </option>
                                                        <option value="06"
                                                            <?php if($selected_month == '06') echo 'selected';?>>
                                                            June
                                                        </option>
                                                        <option value="07"
                                                            <?php if($selected_month == '07') echo 'selected';?>>
                                                            July
                                                        </option>
                                                        <option value="08"
                                                            <?php if($selected_month == '08') echo 'selected';?>>
                                                            August
                                                        </option>
                                                        <option value="09"
                                                            <?php if($selected_month == '09') echo 'selected';?>>
                                                            September
                                                        </option>
                                                        <option value="10"
                                                            <?php if($selected_month == '10') echo 'selected';?>>
                                                            October
                                                        </option>
                                                        <option value="11"
                                                            <?php if($selected_month == '11') echo 'selected';?>>
                                                            November
                                                        </option>
                                                        <option value="12"
                                                            <?php if($selected_month == '12') echo 'selected';?>>
                                                            December
                                                        </option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?=form_close();?>
                                        </div>

                                        <div class="col-md-4 offset-md-4">
                                            <?=form_open('group_sales_admin');?>
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Search</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="search_term"
                                                        value="<?=$search_term?>">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit"
                                                            id="button-addon2"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?=form_close();?>
                                        </div>
                                    </div>

                                    <!-- ---------------------------------------------------------------------------------- -->
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">

                                                    <li class="page-item active"><a class="page-link" href="#">1</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div> -->

                                    <!-- ---------------------------------------------------------------------------------- -->
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Bonus(USD)</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                            
                                if(isset($members)){
                                    foreach($members as $user){ 
                                        if(strlen($search_term) == 0){
                                            echo form_open('group_sales_admin/apply_bonus/---/'.$offset);
                                        }else{
                                            echo form_open('group_sales_admin/apply_bonus/'.$search_term.'/'.$offset);
                                        }
                                        ?>
                                            <tr>
                                                <th scope="row"><?=$user['full_name']?></th>
                                                <td>
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        name="username" value="<?=$user['username']?>">
                                                    <input type="text" readonly name="user_id"
                                                        value="<?=$user['member_id']?>" hidden>
                                                    <input type="text" readonly name="bonus_month" hidden
                                                        class="form-control-plaintext"
                                                        value="<?=$user['bonus_month']?>">
                                                    <?php if($user['bonus'] > 0){ ?>

                                                    <input type="text" readonly name="updateable" hidden
                                                        class="form-control-plaintext" value="updateable">
                                                    <?php
                                                        }?>
                                                </td>
                                                <td>
                                                    <?=$user['month_name']?>
                                                </td>
                                                <td>
                                                    <input type="number" name="member_bonus" min="0"
                                                        class="form-control form-control-sm" placeholder="$0.00"
                                                        value="<?=$user['bonus']?>">
                                                </td>
                                                <td>
                                                    <?php if($user['bonus'] == "0") {?>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">
                                                        Apply
                                                    </button>
                                                    <?php } else{ ?>
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">
                                                        Update
                                                    </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <?php
                                            echo form_close();
                                    }
                                }

                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</div>
</section>
</div>