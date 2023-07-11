<div class="card card-bordered h-100">
    <div class="card-inner h-100 stretch flex-column">
        <div class="card-title-group">
            <div class="card-title card-title-sm">
                <h6 class="title">Income Breakdown</h6>
            </div>
            <div class="card-tools">
                <div class="drodown">
                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><span>7 Days</span></a></li>
                            <li><a href="#"><span>15 Days</span></a></li>
                            <li><a href="#"><span>30 Days</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="device-status my-auto">
            <div class="device-status-ck">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                    <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                </div>
                <canvas class="income-doughnut chartjs-render-monitor" id="incomeBreakdownData" style="display: block; width: 272px; height: 160px;" width="272" height="160"></canvas>
            </div>
            <div class="device-status-group">
                <?php foreach($incomeBreakdown as $income): ?>
                <div class="device-status-data">
                    <em class="icon ni ni-money" style="color: <?php echo $income['color']; ?>;"></em>
                    <div class="title"><?php echo 
                    $income['source_type']; ?></div>
                    <div class="amount"><?php echo $income['percentage']; ?>%</div>
                    <div class="change <?php echo $income['change'] > 0 ? 'up text-danger' : 'down text-success'; ?>">
                        <em class="icon ni ni-arrow-long-<?php echo $income['change'] > 0 ? 'up' : 'down'; ?>"></em><?php echo abs($income['change']); ?>%
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
    // convert PHP array to JavaScript array
    var incomeBreakdown = <?php echo json_encode($incomeBreakdown); ?>;

    // prepare datasets for Chart.js
    var labels = [];
    var data = [];
    var backgroundColors = [];

    for (var i = 0; i < incomeBreakdown.length; i++) {
        labels.push(incomeBreakdown[i].source_type);
        data.push(incomeBreakdown[i].percentage);
        backgroundColors.push(incomeBreakdown[i].color);
    }

    var ctx = document.getElementById('incomeBreakdownData').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors
            }]
        },
        options: { plugins: { legend: { display: false }, } }
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false  // Hide the legend
                },
            },
            
            tooltips: {
                    enabled: false  // Disable tooltips
                }
        }
    });
</script>

