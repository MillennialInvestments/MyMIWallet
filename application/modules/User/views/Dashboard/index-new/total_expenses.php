<div class="card card-bordered  card-full">
    <div class="card-inner">
        <div class="card-title-group align-start mb-0">
            <div class="card-title">
                <a href="<?php echo site_url('/Budget'); ?>">
<<<<<<< HEAD
                    <h6 class="subtitle">Projected Expenses</h6>
=======
                    <h6 class="subtitle">Projected Annual Expenses</h6>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                </a>
            </div>
            <div class="card-tools">
                <a href="<?php echo site_url('/Budget/Add/Expense'); ?>">
<<<<<<< HEAD
                    <em class="card-hint icon ni ni-plus statusGreen"></em>
=======
                    <em class="card-hint icon ni ni-plus"></em>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                </a>
                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Balance in Account"></em>
            </div>
        </div>
        <div class="card-amount">
<<<<<<< HEAD
            <span class="amount"> <?php echo $totalMonthlyExpenses; ?></span>
=======
            <span class="amount"> <?php echo $totalAnnualExpenses; ?></span>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em><?php echo $momExpenseAverages; ?>%</span>
        </div>
        <div class="invest-data">
            <div class="invest-data-amount g-2">
                <div class="invest-data-history">
<<<<<<< HEAD
                    <div class="title">Last Month</div>
                    <div class="amount"><?php echo $totalLastMonthExpenses; ?> </div>
                </div>
                <div class="invest-data-history">
                    <div class="title">This Month</div>
                    <div class="amount"><?php echo $totalAnnualExpenses; ?> </div>
=======
                    <div class="title">This Month</div>
                    <div class="amount"><?php echo $totalMonthlyExpenses; ?> </div>
                </div>
                <div class="invest-data-history">
                    <div class="title">Last Month</div>
                    <div class="amount"><?php echo $totalLastMonthExpenses; ?> </div>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                </div>
            </div>
            <div class="invest-data-ck">
                <canvas class="iv-data-chart" id="totalBalance"></canvas>
            </div>
        </div>
        <div class="invest-data pt-3 h-10">
            <a class="btn btn-primary btn-md" href="<?php echo site_url('/Budget/Expenses'); ?>">Manage Expenses</a>
        </div>
    </div>
</div><!-- .card -->