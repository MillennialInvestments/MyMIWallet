<div class="h-100" style="max-height: 400px;">
    <canvas class="order-overview-chart" id="orderOverview"></canvas>
</div>
<script>
        NioApp.coms.docReady.push(function () {
        lineProfileBalance();
    });
    var orderOverview = {
        labels: ["19 Dec", "20 Dec", "21 Dec", "22 Dec", "23 Dec", "24 Dec", "25 Dec", "26 Dec", "27 Dec", "28 Dec", "29 Dec", "30 Dec", "31 Dec", "01 Jan"],
        dataUnit: 'USD',
        datasets: [{
        label: "Buy Orders",
        color: "#8feac5",
        data: [1740, 2500, 1820, 1200, 1600, 2500, 1820, 1200, 1700, 1820, 1400, 1600, 1930, 2100]
        }, {
        label: "Sell Orders",
        color: "#9cabff",
        data: [2420, 1820, 3000, 5000, 2450, 1820, 2700, 5000, 2400, 2600, 4000, 2380, 2120, 1700]
        }]
    };

    function orderOverviewChart(selector, set_data) {
        var $selector = selector ? $(selector) : $('.order-overview-chart');
        $selector.each(function () {
        var $self = $(this),
            _self_id = $self.attr('id'),
            _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
            _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;

        var selectCanvas = document.getElementById(_self_id).getContext("2d");
        var chart_data = [];

        for (var i = 0; i < _get_data.datasets.length; i++) {
            chart_data.push({
            label: _get_data.datasets[i].label,
            data: _get_data.datasets[i].data,
            // Styles
            backgroundColor: _get_data.datasets[i].color,
            borderWidth: 2,
            borderColor: 'transparent',
            hoverBorderColor: 'transparent',
            borderSkipped: 'bottom',
            barPercentage: .8,
            categoryPercentage: .6
            });
        }

        var chart = new Chart(selectCanvas, {
            type: 'bar',
            data: {
            labels: _get_data.labels,
            datasets: chart_data
            },
            options: {
            legend: {
                display: _get_data.legend ? _get_data.legend : false,
                labels: {
                boxWidth: 30,
                padding: 20,
                fontColor: '#6783b8'
                }
            },
            maintainAspectRatio: false,
            tooltips: {
                enabled: true,
                rtl: NioApp.State.isRTL,
                callbacks: {
                title: function title(tooltipItem, data) {
                    return data.datasets[tooltipItem[0].datasetIndex].label;
                },
                label: function label(tooltipItem, data) {
                    return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                }
                },
                backgroundColor: '#eff6ff',
                titleFontSize: 13,
                titleFontColor: '#6783b8',
                titleMarginBottom: 6,
                bodyFontColor: '#9eaecf',
                bodyFontSize: 12,
                bodySpacing: 4,
                yPadding: 10,
                xPadding: 10,
                footerMarginTop: 0,
                displayColors: false
            },
            scales: {
                yAxes: [{
                display: true,
                stacked: _get_data.stacked ? _get_data.stacked : false,
                position: NioApp.State.isRTL ? "right" : "left",
                ticks: {
                    beginAtZero: true,
                    fontSize: 11,
                    fontColor: '#9eaecf',
                    padding: 10,
                    callback: function callback(value, index, values) {
                    return '$ ' + value;
                    },
                    min: 100,
                    max: 5000,
                    stepSize: 1200
                },
                gridLines: {
                    color: NioApp.hexRGB("#526484", .2),
                    tickMarkLength: 0,
                    zeroLineColor: NioApp.hexRGB("#526484", .2)
                }
                }],
                xAxes: [{
                display: true,
                stacked: _get_data.stacked ? _get_data.stacked : false,
                ticks: {
                    fontSize: 9,
                    fontColor: '#9eaecf',
                    source: 'auto',
                    padding: 10,
                    reverse: NioApp.State.isRTL
                },
                gridLines: {
                    color: "transparent",
                    tickMarkLength: 0,
                    zeroLineColor: 'transparent'
                }
                }]
            }
            }
        });
        });
    } // init chart


    NioApp.coms.docReady.push(function () {
        orderOverviewChart();
    });
    var userActivity = {
        labels: ["01 Nov", "02 Nov", "03 Nov", "04 Nov", "05 Nov", "06 Nov", "07 Nov", "08 Nov", "09 Nov", "10 Nov", "11 Nov", "12 Nov", "13 Nov", "14 Nov", "15 Nov", "16 Nov", "17 Nov", "18 Nov", "19 Nov", "20 Nov", "21 Nov"],
        dataUnit: 'USD',
        stacked: true,
        datasets: [{
        label: "Direct Join",
        color: "#9cabff",
        data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90]
        }, {
        label: "Referral Join",
        color: NioApp.hexRGB("#9cabff", .4),
        data: [125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
        }]
    };
</script>