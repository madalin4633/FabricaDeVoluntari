let activityChart = document.getElementById('activityChart').getContext('2d');
Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontSize = 15;
let volunteersChart = new Chart(activityChart, {
    type: 'horizontalBar',
    data: {
        labels:['Mihai Vornicu', 'Meseriasul din Copou', 'Mr. Madalinos'],
        datasets:[{
            label: 'Population',
            backgroundColor: '#ffffff',
            data: [
                2034,
                251235,
                3462
            ]
        }],
        options: {
            responsive: true,
            legend: { 
                display: false
            },
            title: {
              display: true,
              text: 'Predicted world population (millions) in 2050'
            }
        }
    }
});