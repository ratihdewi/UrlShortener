<script type="text/javascript">

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}


const yearlyLabels = @json($menunggu_persetujuan_yearly_data->keys())

const menungguPersetujuanYearlyData = @json($menunggu_persetujuan_yearly_data->values())

const sedangBerjalanYearlyData = @json($sedang_berjalan_yearly_data->values())

const selesaiYearlyData = @json($selesai_yearly_data->values())

const batalYearlyData = @json($batal_yearly_data->values())

var ctx = document.getElementById('chartPemasukan');
var myLineChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: yearlyLabels,
        datasets: [{
            label: "Menunggu Persetujuan ",
            lineTension: 0.3,
            backgroundColor: "rgba(230, 126, 34,0.5)",
            borderColor: "rgba(230, 126, 34,1.0)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(230, 126, 34,1.0)",
            pointBorderColor: "rgba(230, 126, 34,1.0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(230, 126, 34,1.0)",
            pointHoverBorderColor: "rgba(230, 126, 34,1.0)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: menungguPersetujuanYearlyData
        }, {
            label: "Sedang Berjalan ",
            lineTension: 0.3,
            backgroundColor: "rgba(46, 204, 113,0.5)",
            borderColor: "rgba(46, 204, 113,1.0)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(46, 204, 113,1.0)",
            pointBorderColor: "rgba(46, 204, 113,1.0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(46, 204, 113,1.0)",
            pointHoverBorderColor: "rgba(46, 204, 113,1.0)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: sedangBerjalanYearlyData
        }, {
            label: "Selesai ",
            lineTension: 0.3,
            backgroundColor: "rgba(52, 152, 219, 0.5)",
            borderColor: "rgba(52, 152, 219, 1.0)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(52, 152, 219, 1.0)",
            pointBorderColor: "rgba(52, 152, 219, 1.0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(52, 152, 219, 1.0)",
            pointHoverBorderColor: "rgba(52, 152, 219, 1.0)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: selesaiYearlyData
        }, {
            label: "Dibatalkan ",
            lineTension: 0.3,
            backgroundColor: "rgba(192, 57, 43, 0.5)",
            borderColor: "rgba(192, 57, 43, 1.0)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(192, 57, 43, 1.0)",
            pointBorderColor: "rgba(192, 57, 43, 1.0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(192, 57, 43, 1.0)",
            pointHoverBorderColor: "rgba(192, 57, 43, 1.0)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: batalYearlyData
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: "date"
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value);
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }]
        },
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return datasetLabel  + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});


const weeklyLabels = @json($menunggu_persetujuan_weekly_data->keys())

const menungguPersetujuanWeeklyData = @json($menunggu_persetujuan_weekly_data->values())

const sedangBerjalanWeeklyData = @json($sedang_berjalan_weekly_data->values())

const selesaiWeeklyData = @json($selesai_weekly_data->values())

const batalWeeklyData = @json($batal_weekly_data->values())

var ctx = document.getElementById('chartPemasukan2');
var myLineChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: weeklyLabels,
        datasets: [{
            label: "Menunggu Persetujuan ",
            lineTension: 0.3,
            backgroundColor: "rgba(230, 126, 34,0.5)",
            borderColor: "rgba(230, 126, 34,1.5)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(230, 126, 34,1.5)",
            pointBorderColor: "rgba(230, 126, 34,1.5)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(230, 126, 34,1.5)",
            pointHoverBorderColor: "rgba(230, 126, 34,1.5)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: menungguPersetujuanWeeklyData
        }, {
            label: "Sedang Berjalan ",
            lineTension: 0.3,
            backgroundColor: "rgba(46, 204, 113,0.5)",
            borderColor: "rgba(46, 204, 113,1.5)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(46, 204, 113,1.5)",
            pointBorderColor: "rgba(46, 204, 113,1.5)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(46, 204, 113,1.5)",
            pointHoverBorderColor: "rgba(46, 204, 113,1.5)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: sedangBerjalanWeeklyData
        }, {
            label: "Selesai ",
            lineTension: 0.3,
            backgroundColor: "rgba(52, 152, 219, 0.5)",
            borderColor: "rgba(52, 152, 219, 1.0)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(52, 152, 219, 1.0)",
            pointBorderColor: "rgba(52, 152, 219, 1.0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(52, 152, 219, 1.0)",
            pointHoverBorderColor: "rgba(52, 152, 219, 1.0)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: selesaiWeeklyData
        }, {
            label: "Dibatalkan ",
            lineTension: 0.3,
            backgroundColor: "rgba(192, 57, 43, 0.5)",
            borderColor: "rgba(192, 57, 43, 1.0)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(192, 57, 43, 1.0)",
            pointBorderColor: "rgba(192, 57, 43, 1.0)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(192, 57, 43, 1.0)",
            pointHoverBorderColor: "rgba(192, 57, 43, 1.0)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: batalWeeklyData
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: "date"
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value);
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }]
        },
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return datasetLabel  + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});



// Pie Chart Example
const pieLables = @json($pie_label)

const pieCount = @json($pie_count)

var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: pieLables,
        datasets: [{
            data: pieCount,
            backgroundColor: [
                "rgba(0, 97, 242, 1)",
                "rgba(0, 172, 105, 1)",
                "rgba(88, 0, 232, 1)"
            ],
            hoverBackgroundColor: [
                "rgba(0, 97, 242, 0.9)",
                "rgba(0, 172, 105, 0.9)",
                "rgba(88, 0, 232, 0.9)"
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)"
        }]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80
    }
});

// Pie Chart Example

const pieSum = @json($pie_sum)

var ctx = document.getElementById("myPieChart2");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: pieLables,
        datasets: [{
            data: pieSum,
            backgroundColor: [
                "rgba(0, 97, 242, 1)",
                "rgba(0, 172, 105, 1)",
                "rgba(88, 0, 232, 1)"
            ],
            hoverBackgroundColor: [
                "rgba(0, 97, 242, 0.9)",
                "rgba(0, 172, 105, 0.9)",
                "rgba(88, 0, 232, 0.9)"
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)"
        }]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80
    }
});




</script>