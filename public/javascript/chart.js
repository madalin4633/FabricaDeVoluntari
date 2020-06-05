let fetchBtn = document.getElementById("LastWeek");
fetchBtn.addEventListener("click", onClick);

function onClick(){
    fetchBtn.setAttribute("disabled", true);
    fetchBtn.textContent = 'Se incarca...';

    const myNaiveUrl = `/api/associations/${assoc_id}/myactivity`;
    fetch(myNaiveUrl)
        .then(function(resp){
            return resp.json();
        })
        .then(function (jsonResp) {
            console.log(jsonResp);

            var names = jsonResp.map(function (e) {
                return e.nume_prenume;
              });
            
            var hours = jsonResp.map(function (e) {
                return e.ore_lucrate;
              });
            
            var tasks = jsonResp.map(function (e){
                return e.nr_taskuri;
            });

            let activityChart = document.getElementById('activityChart').getContext('2d');
Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontSize = 15;
let volunteersChart = new Chart(activityChart, {
    type: 'horizontalBar',
    data: {
        //labels: names,
        labels: ['marcule sadlfknasd', 'asdfasdfasd asfdasf', 'asdfasdf aherje', 'ahahre reh eh', 'erheraerh erh', 'aerhaeryaery'],
        datasets:[{
            label: 'Ore de voluntariat',
            backgroundColor: '#ffffff',
            //data: hours
            data: [23, 12, 23, 5, 15, 0]
        },
        {
            label: 'Task-uri indeplinite si de facut',
            backgroundColor: '#32be8f',
            //data: tasks
            data: [1,5,6,7,2,3]
        }],
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            pan: {
                // Boolean to enable panning
                enabled: true,
    
                // Panning directions. Remove the appropriate direction to disable 
                // Eg. 'y' would only allow panning in the y direction
                mode: 'y'
            }
        }
    }
});

            fetchBtn.removeAttribute("disabled");
            fetchBtn.textContent = 'Ultima saptamana';
        })
        .catch(function (){
            //error
        })
/* 
    setTimeout(function() {
        console.log("AJAX call done - data fetched!");


        
    }, 1000); */
}