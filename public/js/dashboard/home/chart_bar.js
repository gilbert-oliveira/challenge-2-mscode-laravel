const data = {
    labels: labelsBar,
    datasets: [{
        label: 'Tickets',
        backgroundColor: '#2C96CC',
        data: datasBar,
    }]
};

let delayed;
const chartBar = new Chart(
    document.getElementById('ticketsForDays'),
    {
        type: 'bar',
        data: data,
        options: {
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                        delay = context.dataIndex * 80 + context.datasetIndex * 100;
                    }
                    return delay;
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: Math.max.apply(null, datasBar) + 1
                }
            }
        }
    }
);
