let weekBtn = document.getElementById("LastWeek");
weekBtn.addEventListener("click", onClickWeek);

function onClickWeek(){
    weekBtn.setAttribute("disabled", true);
    weekBtn.textContent = 'Se incarca...';
    var exLabels = ['marculeeeee sadlfknasd', 'asdfasdfasd asfdasf', 'asdfasdf aherje', 'ahahre reh eh', 'erheraerh erh', 'aerhaeryaery', 'asdgas asdg', 'a23a23ta23tagd', 'a23ya23y a'];
    var exHours = [23, 12, 23, 5, 15, 0, 5, 6, 2];
    var exTasks = [1,5,6,7,2,3, 1, 1, 1];

    const myNaiveUrl = `/api/associations/${assoc_id}/myactivity?filter_by=last_week`;
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

            document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

            let activityChart = document.getElementById('activityChart').getContext('2d');
            Chart.defaults.global.defaultFontColor = 'white';
            Chart.defaults.global.defaultFontSize = 15;
            document.getElementById("chartContainer").style.border = "5px dashed black";
let volunteersChart = new Chart(activityChart, {
    type: 'bar',
    data: {
        //labels: names,
        labels: exLabels,
        datasets:[{
            label: 'Ore de voluntariat',
            backgroundColor: '#ffffff',
            //data: hours
            data: exHours
        },
        {
            label: 'Task-uri indeplinite si de facut',
            backgroundColor: '#32be8f',
            //data: tasks
            data: exTasks
        }],
        options: {
            responsive: true,
            maintainAspectRatio: false,
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

            addTable(exLabels,exHours,exTasks);
            weekBtn.removeAttribute("disabled");
            weekBtn.textContent = 'Ultima saptamana';
        })
        .catch(function (){
            //error
        })
/* 
    setTimeout(function() {
        console.log("AJAX call done - data fetched!");


        
    }, 1000); */
    function addTable(lbs, hrs, tks) {
        var myTableDiv = document.getElementById("myDynamicTable");
      
        var table = document.createElement('TABLE');
        table.style.backgroundColor = 'white';
        table.style.border = '2px solid #38d39f';

        var tableBody = document.createElement('TBODY');
        table.appendChild(tableBody);
      
        for (var i = 0; i <= lbs.length; i++) {
          var tr = document.createElement('TR');
          tableBody.appendChild(tr);
          for (var j = 0; j <= 2; j++) {
            var td = document.createElement('TD');
            td.width = '150';
              if(i==0 && j==0)
              {
                td.appendChild(document.createTextNode("Nume si prenume"));
                td.style.textAlign='center';
              }
              else if(i==0 && j==1)
              {
                td.appendChild(document.createTextNode("Ore adunate"));
                td.style.textAlign='center';
              }
              else if(i==0 && j==2)
              {
                td.appendChild(document.createTextNode("Nr. task-uri"));
                td.style.textAlign='center';
              }
              else if(j==0)
                td.appendChild(document.createTextNode(lbs[i-1]));
              else if(j==1)
              {
                td.appendChild(document.createTextNode(hrs[i-1]));
                td.style.textAlign='center';
              }
              else if(j==2)
              {
                td.appendChild(document.createTextNode(tks[i-1]));
                td.style.textAlign='center';
              }
            tr.appendChild(td);
          }
        }
        myTableDiv.appendChild(table);
      }

}