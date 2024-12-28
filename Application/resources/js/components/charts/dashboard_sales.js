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