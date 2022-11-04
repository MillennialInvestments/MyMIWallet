<div class="card card-bordered  card-full">
    <div class="card-inner">
        <div class="card-title-group align-start mb-0">
            <div class="card-title">
                <a href="<?php echo site_url('/Budget'); ?>">
                    <h6 class="subtitle">Projected Annual Income</h6>
                </a>
            </div>
            <div class="card-tools">
                <a href="<?php echo site_url('/Budget/Add/Income'); ?>">
                    <em class="card-hint icon ni ni-plus"></em>
                </a>
                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Balance in Account"></em>
            </div>
        </div> 
        <div class="card-amount">
            <span class="amount"> <?php echo $totalAnnualIncome; ?></span>
            <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em><?php echo $momIncomeAverages; ?>%</span>
        </div>
        <div class="invest-data">
            <div class="invest-data-amount g-2">
                <div class="invest-data-history">
                    <div class="title">This Month</div>
                    <div class="amount"><?php echo $totalMonthlyIncome; ?> </div>
                </div>
                <div class="invest-data-history">
                    <div class="title">Last Month</div>
                    <div class="amount"><?php echo $totalLastMonthIncome; ?> </div>
                </div> 
            </div>
            <div class="invest-data-ck">
                <canvas class="iv-data-chart" id="totalDeposit"></canvas>
            </div>
        </div>
        <div class="invest-data pt-3 h-10">
            <a class="btn btn-primary btn-md" href="<?php echo site_url('/Budget/Income'); ?>">Manage Income</a>
        </div>
    </div>
</div><!-- .card -->