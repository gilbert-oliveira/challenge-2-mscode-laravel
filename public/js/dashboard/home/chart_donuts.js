const dataDonuts = {
    datasets: [{
        data: datasDonuts,
        backgroundColor: ['#00a3bc', '#d30074'],
    }]
};

let delayedDonuts;
const chartDonuts = new Chart(
    document.getElementById('percentageOfTickets'),
    {
        type: 'doughnut',
        data: dataDonuts,
        plugins: [ChartDataLabels],
        options: {
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        const sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    color: '#ffffff',
                    font: {
                        size: '13',
                        weight: 'bolder',
                    }
                }
            }
        }
    }
);
