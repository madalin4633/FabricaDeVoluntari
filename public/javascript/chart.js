let activityChart = document.getElementById('activityChart').getContext('2d');
Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontSize = 15;
let volunteersChart = new Chart(activityChart, {
    type: 'horizontalBar',
    data: {
        labels:['Dobre Dani', 'Bejan Valeriu', 'Madalin Florea'],
        datasets:[{
            label: 'Ore de voluntariat',
            backgroundColor: '#ffffff',
            data: [
                52,
                40,
                60
            ],
            borderColor: [
                '#D3E4F3',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 3
        },
        {
            label: 'Task-uri indeplinite',
            backgroundColor: '#002135',
            data: [
                5,
                4,
                6
            ],
            borderColor: [
                '#000000',
                'rgba(54, 0, 235, 1)',
                'rgba(255, 0, 86, 1)'
            ],
            borderWidth: 3
        }],
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    }
});