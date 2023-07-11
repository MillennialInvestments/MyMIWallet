<div class="h-100 card card-bordered">
    <div class="h-100 card-inner flex-column stretch">
        <div class="card-title-group">
            <div class="card-title card-title-sm">
                <h6 class="title">Income Breakdown</h6>
            </div>
            <div class="card-tools">
                <div class="drodown">
                    <a href="#" class="btn btn-outline-light btn-sm btn-white dropdown-indicator dropdown-toggle" data-bs-toggle="dropdown">30 Days</a>
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
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas class="chartjs-render-monitor income-doughnut" height="160" id="totalActiveReferrals" style="display:block;width:272px;height:160px" width="272"></canvas>
            </div>
            <div class="device-status-group">
                <?php foreach($sourceBreakdown as $source): ?>
                <div class="device-status-data">
                    <em class="icon ni ni-money" style="color:<?php echo $source['color']; ?>"></em>
                    <div class="title"><?php echo $source['source_type']; ?></div>
                    <div class="amount"><?php echo $source['percentage']; ?>%</div>
                    <div class="change<?php echo $source['change'] > 0 ? 'up text-success' : 'down text-danger'; ?>">
                        <em class="icon ni ni-arrow-long-<?php echo $source['change'] > 0 ? 'up' : 'down'; ?>"></em>
                        <?php echo abs($source['change']); ?>%
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var sourceBreakdown = <?php echo json_encode($sourceBreakdown); ?>;
    var labels = [];
    var data = [];
    var backgroundColors = [];

    let ctx = document.getElementById('totalActiveReferrals').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [/* Dates from your data here */],
            datasets: [{
                label: labels,
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
