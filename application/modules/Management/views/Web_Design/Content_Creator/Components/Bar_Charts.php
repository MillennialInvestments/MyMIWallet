<div id="Working barchart">
    <h2>
        Working barchart for budgeting
    </h2>

    <svg id="my_dataviz"></svg>

    <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
    <script>
        data=[
            {amount: -123, wallet: "damn"},
            {amount: 500, wallet: "man2"},
            {amount: -200, wallet: "man"},
            {amount: 1000, wallet: "damn2"},
        ];
        const
            width = 960,
            height = 500;

        const x_scale = d3.scaleBand().range([0, width]);
        const y_scale = d3.scaleLinear().range([height, 0]);

        const svg = d3.select("#my_dataviz")
        .attr("width", width)
        .attr("height", height);

        x_scale.domain(data.map((d) => d.wallet));
        y_scale.domain([0,  d3.max(data, (d) => d.amount)]);

        svg
            .selectAll("rect")
            .data(data)
            .join("rect")
            .attr("class","bar")
            .attr("x", (d)=> x_scale(d.wallet))
            .attr("y",(d)=> y_scale(Math.abs(d.amount)) )
            .attr("width", x_scale.bandwidth())
            .attr("height", (d) => height - y_scale( Math.abs(d.amount)))
            .attr("fill", (d) => Math.abs(d.amount)==d.amount ? "green":"red");


            //Axis
            svg.append("g")
        .attr("transform","translate(0,"+height+")")
        .call(d3.axisBottom(x_scale).tickFormat(function(d){
        return"Wallet:"+d;
        })
        );

        svg.append("g")
        .call(d3.axisLeft(y_scale).tickFormat(function(d){
        return"$"+d;
        }).ticks(4));

    </script>
    <script>
        "use strict";
        !(function (NioApp, $) {
            var barChartData = {
                    labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
                    dataUnit: "People",
                    datasets: [
                        { label: "join", color: "#b695ff", data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90] },
                        { label: "join", color: "#b695ff", data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90] },
                    ],
                },
                barChartMultiple = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    dataUnit: "USD",
                    datasets: [
                        { label: "Income", color: "#b695ff", data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95] },
                        { label: "Expense", color: "#f4aaa4", data: [75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125] },
                    ],
                },
                barChartStacked = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    stacked: !0,
                    dataUnit: "USD",
                    datasets: [
                        { label: "Income", color: "#b695ff", data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95] },
                        { label: "Expense", color: "#f4aaa4", data: [75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125] },
                    ],
                };
            function barChart(selector, set_data) {
                var $selector = $(selector || ".bar-chart");
                $selector.each(function () {
                    for (
                        var $self = $(this),
                            _self_id = $self.attr("id"),
                            _get_data = void 0 === set_data ? eval(_self_id) : set_data,
                            _d_legend = void 0 !== _get_data.legend && _get_data.legend,
                            selectCanvas = document.getElementById(_self_id).getContext("2d"),
                            chart_data = [],
                            i = 0;
                        i < _get_data.datasets.length;
                        i++
                    )
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            data: _get_data.datasets[i].data,
                            backgroundColor: _get_data.datasets[i].color,
                            borderWidth: 2,
                            borderColor: "transparent",
                            hoverBorderColor: "transparent",
                            borderSkipped: "bottom",
                            barPercentage: 0.6,
                            categoryPercentage: 0.7,
                        });
                    var chart = new Chart(selectCanvas, {
                        type: "bar",
                        data: { labels: _get_data.labels, datasets: chart_data },
                        options: {
                            legend: { display: _get_data.legend || !1, rtl: NioApp.State.isRTL, labels: { boxWidth: 30, padding: 20, fontColor: "#6783b8" } },
                            maintainAspectRatio: !1,
                            tooltips: {
                                enabled: !0,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function (a, t) {
                                        return t.datasets[a[0].datasetIndex].label;
                                    },
                                    label: function (a, t) {
                                        return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit;
                                    },
                                },
                                backgroundColor: "#eff6ff",
                                titleFontSize: 13,
                                titleFontColor: "#6783b8",
                                titleMarginBottom: 6,
                                bodyFontColor: "#9eaecf",
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: !1,
                            },
                            scales: {
                                yAxes: [
                                    {
                                        display: !0,
                                        stacked: _get_data.stacked || !1,
                                        position: NioApp.State.isRTL ? "right" : "left",
                                        ticks: { beginAtZero: !0, fontSize: 12, fontColor: "#9eaecf" },
                                        gridLines: { color: NioApp.hexRGB("#526484", 0.2), tickMarkLength: 0, zeroLineColor: NioApp.hexRGB("#526484", 0.2) },
                                    },
                                ],
                                xAxes: [
                                    {
                                        display: !0,
                                        stacked: _get_data.stacked || !1,
                                        ticks: { fontSize: 12, fontColor: "#9eaecf", source: "auto", reverse: NioApp.State.isRTL },
                                        gridLines: { color: "transparent", tickMarkLength: 10, zeroLineColor: "transparent" },
                                    },
                                ],
                            },
                        },
                    });
                });
            }
            barChart();
            var solidLineChart = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    dataUnit: "BTC",
                    lineTension: 0.4,
                    legend: !0,
                    datasets: [
                        { label: "Total Received", color: "#5ce0aa", background: "transparent", data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95] },
                        { label: "Total Send", color: "#9d72ff", background: "transparent", data: [80, 54, 105, 120, 82, 85, 60, 80, 54, 105, 120, 82] },
                    ],
                },
                filledLineChart = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    dataUnit: "BTC",
                    lineTension: 0.4,
                    datasets: [{ label: "Total Received", color: "#9d72ff", background: NioApp.hexRGB("#9d72ff", 0.4), data: [110, 80, 125, 65, 95, 75, 90, 110, 80, 125, 70, 95] }],
                },
                straightLineChart = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    dataUnit: "BTC",
                    lineTension: 0,
                    datasets: [{ label: "Total Received", color: "#9d72ff", background: NioApp.hexRGB("#9d72ff", 0.3), data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95] }],
                };
            function lineChart(selector, set_data) {
                var $selector = $(selector || ".line-chart");
                $selector.each(function () {
                    for (
                        var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0;
                        i < _get_data.datasets.length;
                        i++
                    )
                        chart_data.push({
                            label: _get_data.datasets[i].label,
                            tension: _get_data.lineTension,
                            backgroundColor: _get_data.datasets[i].background,
                            borderWidth: 2,
                            borderColor: _get_data.datasets[i].color,
                            pointBorderColor: _get_data.datasets[i].color,
                            pointBackgroundColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: _get_data.datasets[i].color,
                            pointBorderWidth: 2,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 2,
                            pointRadius: 4,
                            pointHitRadius: 4,
                            data: _get_data.datasets[i].data,
                        });
                    var chart = new Chart(selectCanvas, {
                        type: "line",
                        data: { labels: _get_data.labels, datasets: chart_data },
                        options: {
                            legend: { display: _get_data.legend || !1, rtl: NioApp.State.isRTL, labels: { boxWidth: 12, padding: 20, fontColor: "#6783b8" } },
                            maintainAspectRatio: !1,
                            tooltips: {
                                enabled: !0,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function (a, t) {
                                        return t.labels[a[0].index];
                                    },
                                    label: function (a, t) {
                                        return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit;
                                    },
                                },
                                backgroundColor: "#eff6ff",
                                titleFontSize: 13,
                                titleFontColor: "#6783b8",
                                titleMarginBottom: 6,
                                bodyFontColor: "#9eaecf",
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: !1,
                            },
                            scales: {
                                yAxes: [
                                    {
                                        display: !0,
                                        position: NioApp.State.isRTL ? "right" : "left",
                                        ticks: { beginAtZero: !1, fontSize: 12, fontColor: "#9eaecf", padding: 10 },
                                        gridLines: { color: NioApp.hexRGB("#526484", 0.2), tickMarkLength: 0, zeroLineColor: NioApp.hexRGB("#526484", 0.2) },
                                    },
                                ],
                                xAxes: [
                                    {
                                        display: !0,
                                        ticks: { fontSize: 12, fontColor: "#9eaecf", source: "auto", padding: 5, reverse: NioApp.State.isRTL },
                                        gridLines: { color: "transparent", tickMarkLength: 10, zeroLineColor: NioApp.hexRGB("#526484", 0.2), offsetGridLines: !0 },
                                    },
                                ],
                            },
                        },
                    });
                });
            }
            lineChart();
            var pieChartData = { labels: ["Send", "Receive", "Withdraw"], dataUnit: "BTC", legend: !1, datasets: [{ borderColor: "#fff", background: ["#b695ff", "#f4aaa4", "#8feac5"], data: [110, 80, 125] }] };
            function pieChart(selector, set_data) {
                var $selector = $(selector || ".pie-chart");
                $selector.each(function () {
                    for (
                        var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0;
                        i < _get_data.datasets.length;
                        i++
                    )
                        chart_data.push({ backgroundColor: _get_data.datasets[i].background, borderWidth: 2, borderColor: _get_data.datasets[i].borderColor, hoverBorderColor: _get_data.datasets[i].borderColor, data: _get_data.datasets[i].data });
                    var chart = new Chart(selectCanvas, {
                        type: "pie",
                        data: { labels: _get_data.labels, datasets: chart_data },
                        options: {
                            legend: { display: _get_data.legend || !1, rtl: NioApp.State.isRTL, labels: { boxWidth: 12, padding: 20, fontColor: "#6783b8" } },
                            rotation: -0.2,
                            maintainAspectRatio: !1,
                            tooltips: {
                                enabled: !0,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function (a, t) {
                                        return t.labels[a[0].index];
                                    },
                                    label: function (a, t) {
                                        return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit;
                                    },
                                },
                                backgroundColor: "#eff6ff",
                                titleFontSize: 13,
                                titleFontColor: "#6783b8",
                                titleMarginBottom: 6,
                                bodyFontColor: "#9eaecf",
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: !1,
                            },
                        },
                    });
                });
            }
            pieChart();
            var doughnutChartData = { labels: ["Send", "Receive", "Withdraw"], dataUnit: "BTC", legend: !1, datasets: [{ borderColor: "#fff", background: ["#b695ff", "#f4aaa4", "#8feac5"], data: [110, 80, 125] }] };
            function doughnutChart(selector, set_data) {
                var $selector = $(selector || ".doughnut-chart");
                $selector.each(function () {
                    for (
                        var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0;
                        i < _get_data.datasets.length;
                        i++
                    )
                        chart_data.push({ backgroundColor: _get_data.datasets[i].background, borderWidth: 2, borderColor: _get_data.datasets[i].borderColor, hoverBorderColor: _get_data.datasets[i].borderColor, data: _get_data.datasets[i].data });
                    var chart = new Chart(selectCanvas, {
                        type: "doughnut",
                        data: { labels: _get_data.labels, datasets: chart_data },
                        options: {
                            legend: { display: _get_data.legend || !1, rtl: NioApp.State.isRTL, labels: { boxWidth: 12, padding: 20, fontColor: "#6783b8" } },
                            rotation: 1,
                            cutoutPercentage: 40,
                            maintainAspectRatio: !1,
                            tooltips: {
                                enabled: !0,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function (a, t) {
                                        return t.labels[a[0].index];
                                    },
                                    label: function (a, t) {
                                        return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit;
                                    },
                                },
                                backgroundColor: "#eff6ff",
                                titleFontSize: 13,
                                titleFontColor: "#6783b8",
                                titleMarginBottom: 6,
                                bodyFontColor: "#9eaecf",
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: !1,
                            },
                        },
                    });
                });
            }
            doughnutChart();
            var polarChartData = {
                labels: ["Send", "Receive", "Withdraw"],
                dataUnit: "BTC",
                legend: !1,
                datasets: [{ borderColor: "#fff", background: [NioApp.hexRGB("#b695ff", 0.8), NioApp.hexRGB("#f4aaa4", 0.8), NioApp.hexRGB("#8feac5", 0.8)], data: [110, 80, 125] }],
            };
            function polarAreaChart(selector, set_data) {
                var $selector = $(selector || ".polar-chart");
                $selector.each(function () {
                    for (
                        var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0;
                        i < _get_data.datasets.length;
                        i++
                    )
                        chart_data.push({ backgroundColor: _get_data.datasets[i].background, borderWidth: 2, borderColor: _get_data.datasets[i].borderColor, hoverBorderColor: _get_data.datasets[i].borderColor, data: _get_data.datasets[i].data });
                    var chart = new Chart(selectCanvas, {
                        type: "polarArea",
                        data: { labels: _get_data.labels, datasets: chart_data },
                        options: {
                            legend: { display: _get_data.legend || !1, rtl: NioApp.State.isRTL, labels: { boxWidth: 12, padding: 20, fontColor: "#6783b8" } },
                            maintainAspectRatio: !1,
                            tooltips: {
                                enabled: !0,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    title: function (a, t) {
                                        return t.labels[a[0].index];
                                    },
                                    label: function (a, t) {
                                        return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit;
                                    },
                                },
                                backgroundColor: "#eff6ff",
                                titleFontSize: 13,
                                titleFontColor: "#6783b8",
                                titleMarginBottom: 6,
                                bodyFontColor: "#9eaecf",
                                bodyFontSize: 12,
                                bodySpacing: 4,
                                yPadding: 10,
                                xPadding: 10,
                                footerMarginTop: 0,
                                displayColors: !1,
                            },
                        },
                    });
                });
            }
            polarAreaChart();
        })(NioApp, jQuery);

    </script>
</div>