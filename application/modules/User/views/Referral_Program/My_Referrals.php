<?php
$cuReferrerCode                         = $_SESSION['allSessionData']['userAccount']['cuReferrerCode'];
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title">My Referrals</h1>
                        <a href="<?php echo site_url('/Referral-Program/Apply'); ?>">Return to Referral Program</a>							
                    </div>
                </div>
            </div>
            <?php 
            /**
            <div class="nk-block pb-3">
                <div class="row g-gs">
                    <div class="col-md-4">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle">Total Deposit</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Deposited"></em>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount"> 49,595.34 <span class="currency currency-usd">USD</span>
                                    </span>
                                    <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-md-4">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle">Total Withdraw</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Withdraw"></em>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount"> 49,595.34 <span class="currency currency-usd">USD</span>
                                    </span>
                                    <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-md-4">
                        <div class="card card-bordered  card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-0">
                                    <div class="card-title">
                                        <h6 class="subtitle">Balance in Account</h6>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Balance in Account"></em>
                                    </div>
                                </div>
                                <div class="card-amount">
                                    <span class="amount"> 79,358.50 <span class="currency currency-usd">USD</span>
                                    </span>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div>
            </div>
            <hr>
             */
            ?>
            <div class="nk-block pt-3">
                <div class="row">
                    <div class="col-12">
                        <table class="table" id="myReferralsDatatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>City/State</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $this->db->from('bf_users'); 
                                    $this->db->where('referral_code', $cuReferrerCode); 
                                    $getReferrals           = $this->db->get(); 
                                    foreach ($getReferrals->result_array() as $referral) {
                                        echo '
                                        <tr>
                                            <td>' . $referral['id'] . '</td>
                                            <td>' . $referral['referral_code'] . '</td>
                                            <td>' . $referral['first_name'] . ' ' . $referral['last_name'] .'</td>
                                            <td>' . $referral['email'] . '</td>
                                            <td>' . $referral['state'] . ' ' . $referral['country'] .'</td>
                                        </td>
                                        ';
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