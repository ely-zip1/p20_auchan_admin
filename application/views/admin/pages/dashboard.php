<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

  <div class="section-body">
      <!-- <h2 class="section-title">Account Summary</h2> -->
      <!-- Your content goes here -->
      <div class="row">
          <div class="col-lg-6">
          <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12"> -->
            <div class="card card-statistic-1 card-info">
              <div class="card-icon bg-info custom-card-blue">
                <i class="fas fa-chart-line"></i>
              </div>
              <div class="card-wrap">
                <div class="row">
                  <div class="col-6">
                    <div class="dash-card"><h3>Profit</h3></div>
                  </div>
                  <div class="col-6">
                    <div class="dash-card">
                      <h4 class="text-center">
                        <span class="badge badge-info">
                          P <?php echo $profit;?>
                        </span>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-statistic-1 card-danger">
              <div class="card-icon bg-danger custom-card-red">
                <i class="fas fa-piggy-bank"></i>
              </div>
              <div class="card-wrap">
              <div class="row">
                  <div class="col-6">
                    <div class="dash-card"><h3>Deposit</h3></div>
                  </div>
                  <div class="col-6">
                    <div class="dash-card">
                      <h4 class="text-center">
                        <span class="badge badge-danger">
                          P <?php echo $deposit;?>
                        </span>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-statistic-1 card-success">
              <div class="card-icon bg-success custom-card-green">
                <i class="fas fa-comments-dollar"></i>
              </div>
              <div class="card-wrap">
              <div class="row">
                  <div class="col-6">
                    <div class="dash-card"><h4>Referral Bonus</h4></div>
                  </div>
                  <div class="col-6">
                    <div class="dash-card">
                      <h4 class="text-center">
                        <span class="badge badge-success">
                          P <?php echo $referral_bonus;?>
                        </span>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card card-statistic-1 card-warning">
              <div class="card-icon bg-warning custom-card-orange">
                <i class="fas fa-wallet"></i>
              </div>
              <div class="card-wrap">
              <div class="row">
                  <div class="col-6">
                    <div class="dash-card"><h3>Balance</h3></div>
                  </div>
                  <div class="col-6">
                    <div class="dash-card">
                      <h4 class="text-center">
                        <span class="badge badge-warning">
                          P <?php echo $balance;?>
                        </span>
                      </h4>
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
