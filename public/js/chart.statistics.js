async function fetchMonthlyStatistics(year) {
    const response = await fetch(`/api/monthly-statistics?year=${year}`);
    const data = await response.json();
    return data;
}

function getMonthLabels(year) {
    const months = [];
    for (let month = 1; month <= 12; month++) {
        months.push(new Date(year, month - 1).toLocaleString('default', { month: 'long' }));
    }
    return months;
}

function formatNumberWithSpaces(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

async function createChart(year) {
    const statistics = await fetchMonthlyStatistics(year);
    const salesData = Object.values(statistics.sales);
    const purchaseData = Object.values(statistics.purchases);
    const totalSales = salesData.reduce((acc, cur) => acc + cur, 0);
    const totalPurchases = purchaseData.reduce((acc, cur) => acc + cur, 0);

    // Update total sales display
    document.getElementById('totalSales').textContent = ` ${formatNumberWithSpaces(totalSales)} MGA`;

    // Update total purchases display
    document.getElementById('totalPurchases').textContent = ` ${formatNumberWithSpaces(totalPurchases)} MGA`;

    const ctx = document.getElementById('monthlyStatisticsChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: getMonthLabels(year),
            datasets: [
                {
                    label: 'Ventes (MGA)',
                    data: salesData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Achats (MGA)',
                    data: purchaseData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' MGA';
                        }
                    }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        const dataset = data.datasets[tooltipItem.datasetIndex];
                        const datasetLabel = dataset.label || '';
                        const dataValue = dataset.data[tooltipItem.index];
                        return datasetLabel + ': ' + dataValue + ' MGA';
                    }
                }
            }
        }
    });
}

document.getElementById('yearSelector').addEventListener('change', function() {
    const selectedYear = this.value;
    createChart(selectedYear);
});

// Initial load
createChart(new Date().getFullYear());