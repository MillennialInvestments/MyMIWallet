<div class="card card-bordered card-full">
    <div class="card-inner">
        <div class="card-title-group align-start mb-0">
            <div class="card-title">
                <h5 class="title fw-bold pb-3">Financial Accounts</h5>
                <h6 class="title fw-bold pb-1">Net worth</h6>
            </div>
            <div class="card-tools">
                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Deposited"></em>
            </div>
        </div>
        <div class="card-amount pb-3">
            <a href="<?php echo site_url('/Budget'); ?>">
                <span class="amount"><?php echo $totalAccountBalance; ?></span>
            </a>
            <!-- <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em><?php //echo $lastAccountBalance; ?></span> -->
        </div>
        <div class="card-body">
            <div class="invest-data">
                <div class="invest-data-amount g-2">
                    <div class="invest-data-history"> 
                        <h6 class="title fw-bold">Checking & Savings</h6>                      
                        <div class="amount"><?php echo $totalFinancialBalance; ?> </div>
                    </div>
                    <div class="invest-data-history">
                        <h6 class="title fw-bold">Credit Cards</h6>
                        <div class="amount"><?php echo $totalInvestmentBalance; ?> </div>
                    </div>
                </div>
            </div>
            <div class="invest-data">
                <div class="invest-data-amount g-2">
                    <div class="invest-data-history"> 
                        <h6 class="title fw-bold">Checking & Savings</h6>                      
                        <div class="amount"><?php echo $totalFinancialBalance; ?> </div>
                    </div>
                    <div class="invest-data-history">
                        <h6 class="title fw-bold">Credit Cards</h6>
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
    </div>
</div><!-- .card -->