let activityChart = document.getElementById('activityChart').getContext('2d');

let volunteersChart = new Chart(activityChart, {
    type: 'horizontalBar',
    data: {
        labels:['Mihai Vornicu', 'Meseriasul din Copou', 'Mr. Madalinos'],
        datasets:[{
            label: 'Population',
            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
            data: [
                2034,
                251235,
                3462
            ]
        }],
        options: {
            responsive: true,
            legend: { display: false },
            title: {
              display: true,
              text: 'Predicted world population (millions) in 2050'
            }
        }
    }
});