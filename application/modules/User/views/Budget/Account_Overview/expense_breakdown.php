<div class="card card-bordered h-100">
    <div class="card-inner h-100 stretch flex-column">
        <div class="card-title-group">
            <div class="card-title card-title-sm">
                <h6 class="title"><?php echo $accountType; ?> Breakdown</h6>
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
                <canvas class="source-doughnut chartjs-render-monitor" id="sourceBreakdownData" style="display: block; width: 272px; height: 160px;" width="272" height="160"></canvas>
            </div>
            <div class="device-status-group">
                <?php foreach($sourceBreakdown as $source): ?>
                <div class="device-status-data">
                    <em class="icon ni ni-money" style="color: <?php echo $source['color']; ?>;"></em>
                    <div class="title"><?php echo 
                    $source['source_type']; ?></div>
                    <div class="amount"><?php echo $source['percentage']; ?>%</div>
                    <div class="change <?php echo $source['change'] > 0 ? 'up text-danger' : 'down text-success'; ?>">
                        <em class="icon ni ni-arrow-long-<?php echo $source['change'] > 0 ? 'up' : 'down'; ?>"></em><?php echo abs($source['change']); ?>%
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script>
    // convert PHP array to JavaScript array
    var sourceBreakdown = <?php echo json_encode($sourceBreakdown); ?>;

    // prepare datasets for Chart.js
    var labels = [];
    var data = [];
    var backgroundColors = [];

    for (var i = 0; i < sourceBreakdown.length; i++) {
        labels.push(sourceBreakdown[i].source_type);
        data.push(sourceBreakdown[i].percentage);
        backgroundColors.push(sourceBreakdown[i].color);
    }

    var ctx = document.getElementById('sourceBreakdownData').getContext('2d');

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

