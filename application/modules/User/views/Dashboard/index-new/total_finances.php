<div class="card card-bordered card-full">
    <div class="card-inner">
        <div class="card-title-group align-start mb-0">
            <div class="card-title">
                <a href="<?php echo site_url('/Budget'); ?>">
                    <h6 class="subtitle">Projected Annual Wealth</h6>
                </a>
            </div>
            <div class="card-tools">
                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Deposited"></em>
            </div>
        </div>
        <div class="card-amount">
            <span class="amount"><?php echo $totalAccountBalance; ?> 
            </span>
            <!-- <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em><?php //echo $lastAccountBalance; ?></span> -->
        </div>
        <div class="invest-data">
            <div class="invest-data-amount g-2">
                <div class="invest-data-history">
                    <div class="title">Personal Finances</div>
                    <div class="amount"><?php echo $totalFinancialBalance; ?> </div>
                </div>
                <div class="invest-data-history">
                    <div class="title">Investments</div>
                    <div class="amount"><?php echo $totalInvestmentBalance; ?> </div>
                </div>
            </div>
            <div class="invest-data-ck">
                <canvas class="iv-data-chart" id="totalDeposit"></canvas>
            </div>
        </div>
        <div class="invest-data pt-3 h-10">
            <a class="btn btn-primary btn-md" href="<?php echo site_url('/Budget'); ?>">Manage Budget</a>
        </div>
    </div>
</div><!-- .card -->