import ApexCharts from 'apexcharts';

(() => {
    const dashboardSalesDiv = document.getElementById('dashboard-this-week-sales');

    if (!dashboardSalesDiv) {
        return;
    }

    const dashboardSalesJsonDiv = document.getElementById('dashboard-this-week-sales-json');

    if (!dashboardSalesJsonDiv) {
        return;
    }

    const dashboardSalesJson = JSON.parse(dashboardSalesJsonDiv.innerText);

    
    const options = {
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "area",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: 0
            },
        },
        series: [
            {
                name: "RON",
                data: dashboardSalesJson.yAxis || [0, 0, 0, 0, 0, 0, 0],
                color: "#1A56DB",
            },
        ],
        xaxis: {
            categories: dashboardSalesJson.xAxis || ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            labels: {
                show: true,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
    }

    if (dashboardSalesDiv && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(dashboardSalesDiv, options);
        chart.render();
    }  
})();

//Users Sales Chart
(() => {
    const dashboardSalesDiv = document.getElementById('dashboard-users-sales');

    if (!dashboardSalesDiv) {
        return;
    }

    const dashboardSalesJsonDiv = document.getElementById('dashboard-users-sales-json');

    if (!dashboardSalesJsonDiv) {
        return;
    }

    const dashboardSalesJson = JSON.parse(dashboardSalesJsonDiv.innerText);

    
    const options = {
        series: Object.values(dashboardSalesJson),
        colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"],
        chart: {
          height: 320,
          width: "100%",
          type: "donut",
        },
        stroke: {
          colors: ["transparent"],
          lineCap: "",
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                name: {
                  show: true,
                  fontFamily: "Inter, sans-serif",
                  offsetY: 20,
                },
                total: {
                  showAlways: true,
                  show: true,
                  label: "Total",
                  fontFamily: "Inter, sans-serif",
                  formatter: function (w) {
                    const sum = w.globals.seriesTotals.reduce((a, b) => {
                      return a + b
                    }, 0)
                    return 'RON ' + sum 
                  },
                },
                value: {
                  show: true,
                  fontFamily: "Inter, sans-serif",
                  offsetY: -20,
                  formatter: function (value) {
                    return "RON " + value 
                  },
                },
              },
              size: "80%",
            },
          },
        },
        grid: {
          padding: {
            top: -2,
          },
        },
        labels: Object.keys(dashboardSalesJson),
        dataLabels: {
          enabled: false,
        },
        legend: {
          position: "bottom",
          fontFamily: "Inter, sans-serif",
        },
        yaxis: {
          labels: {
            formatter: function (value) {
              return "RON " + value 
            },
          },
        },
        xaxis: {
          labels: {
            formatter: function (value) {
              return "RON " + value  
            },
          },
          axisTicks: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
        },
      }
    

    if (dashboardSalesDiv && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(dashboardSalesDiv, options);
        chart.render();
    }  
}
)();