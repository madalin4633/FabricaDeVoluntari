let volunteersChart = null;
var exLabels = ['marculeeeee sadlfknasd', 'asdfasdfasd asfdasf', 'asdfasdf aherje', 'ahahre reh eh', 'erheraerh erh', 'aerhaeryaery', 'asdgas asdg', 'a23a23ta23tagd', 'a23ya23y a'];
var exHours = [23, 12, 23, 5, 15, 0, 5, 6, 2];
var exTasks = [1, 5, 6, 7, 2, 3, 1, 1, 1];
var exAverage = [23, 2, 4, 1, 6, 6, 23, 32, 5];
var exDates = ['23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53', '23.06.2012 23:53']

let weekBtn = document.getElementById("LastWeek");
weekBtn.addEventListener("click", onClickWeek);

let monthBtn = document.getElementById("LastMonth");
monthBtn.addEventListener("click", onClickMonth);

let yearBtn = document.getElementById("LastYear");
yearBtn.addEventListener("click", onClickYear);

function onClickWeek() {
  weekBtn.setAttribute("disabled", true);
  weekBtn.textContent = 'Se incarca...';

  const myNaiveUrl = `/api/associations/${assoc_id}/myactivity?filter_by=last_week`;
  fetch(myNaiveUrl)
    .then(function (resp) {
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

      var tasks = jsonResp.map(function (e) {
        return e.nr_taskuri;
      });

      var hours_tasks = jsonResp.map(function (e) {
        return e.ora_task;
      });

      var last_activity = jsonResp.map(function (e) {
        return e.ultima_activitate;
      });

      document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

      let activityChart = document.getElementById('activityChart').getContext('2d');
      Chart.defaults.global.defaultFontColor = 'white';
      Chart.defaults.global.defaultFontSize = 15;
      document.getElementById("chartContainer").style.border = "5px dashed black";
      if (volunteersChart != null) {
        volunteersChart.destroy();
        volunteersChart = null;
      }
      volunteersChart = new Chart.Bar(activityChart, {
        data: {
          labels: names,
          //labels: exLabels,
          datasets: [{
            label: 'Ore de voluntariat',
            backgroundColor: '#ffffff',
            data: hours
            //data: exHours
          },
          {
            label: 'Task-uri indeplinite si de facut',
            backgroundColor: '#32be8f',
            data: tasks
            //data: exTasks
          }]
        },
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                suggestedMin: 0
              }
            }]
          }
        }
      });

      if (exLabels.length > 0) {
        document.getElementById("myDynamicTable").innerHTML = '';
        addTable(names, hours, tasks, hours_tasks, last_activity);
        //addTable(exLabels, exHours, exTasks, exAverage, exDates);
      }
      else { //ceva - un paragraf sau un text care spune ca nu avem date la acest call
      }
      weekBtn.removeAttribute("disabled");
      weekBtn.textContent = 'Ultima saptamana';

      let htmlBtn = document.getElementById("exportHTML");
      htmlBtn.addEventListener("click", downloadHTML);

      let csvBtn = document.getElementById("exportCSV");
      csvBtn.addEventListener("click", downloadCSV);

      let pdfBtn = document.getElementById("exportPDF");
      pdfBtn.addEventListener("click", function(){
        //downloadPDF(exLabels, exHours, exTasks, exAverage, exDates);
        downloadPDF(names, hours, tasks, hours_tasks, last_activity);
   });
    })
    .catch(function () {
      //error
    })

}

function onClickMonth() {
  monthBtn.setAttribute("disabled", true);
  monthBtn.textContent = 'Se incarca...';

  const myNaiveUrl = `/api/associations/${assoc_id}/myactivity?filter_by=last_month`;
  fetch(myNaiveUrl)
    .then(function (resp) {
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

      var tasks = jsonResp.map(function (e) {
        return e.nr_taskuri;
      });

      var hours_tasks = jsonResp.map(function (e) {
        return e.ora_task;
      });

      var last_activity = jsonResp.map(function (e) {
        return e.ultima_activitate;
      });

      document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

      let activityChart = document.getElementById('activityChart').getContext('2d');
      Chart.defaults.global.defaultFontColor = 'white';
      Chart.defaults.global.defaultFontSize = 15;
      document.getElementById("chartContainer").style.border = "5px dashed black";
      if (volunteersChart != null) {
        volunteersChart.destroy();
        volunteersChart = null;
      }
      volunteersChart = new Chart.Bar(activityChart, {
        data: {
          labels: names,
          //labels: exLabels,
          datasets: [{
            label: 'Ore de voluntariat',
            backgroundColor: '#ffffff',
            data: hours
            //data: exHours
          },
          {
            label: 'Task-uri indeplinite si de facut',
            backgroundColor: '#32be8f',
            data: tasks
            //data: exTasks
          }]
        },
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                suggestedMin: 0
              }
            }]
          }
        }
      });

      if (exLabels.length > 0) {
        //addTable(exLabels, exHours, exTasks);
        document.getElementById("myDynamicTable").innerHTML = '';
        addTable(names, hours, tasks, hours_tasks, last_activity);
      }
      else { //ceva - un paragraf sau un text care spune ca nu avem date la acest call
      }
      monthBtn.removeAttribute("disabled");
      monthBtn.textContent = 'Ultima luna';

      let htmlBtn = document.getElementById("exportHTML");
      htmlBtn.addEventListener("click", downloadHTML);

      let csvBtn = document.getElementById("exportCSV");
      csvBtn.addEventListener("click", downloadCSV);

      let pdfBtn = document.getElementById("exportPDF");
      pdfBtn.addEventListener("click", function(){
        //downloadPDF(exLabels, exHours, exTasks, exAverage, exDates);
        downloadPDF(names, hours, tasks, hours_tasks, last_activity);
   });
    })
    .catch(function () {
      //error
    })

}

function onClickYear() {
  yearBtn.setAttribute("disabled", true);
  yearBtn.textContent = 'Se incarca...';

  const myNaiveUrl = `/api/associations/${assoc_id}/myactivity?filter_by=last_year`;
  fetch(myNaiveUrl)
    .then(function (resp) {
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

      var tasks = jsonResp.map(function (e) {
        return e.nr_taskuri;
      });

      var hours_tasks = jsonResp.map(function (e) {
        return e.ora_task;
      });

      var last_activity = jsonResp.map(function (e) {
        return e.ultima_activitate;
      });

      document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

      let activityChart = document.getElementById('activityChart').getContext('2d');
      Chart.defaults.global.defaultFontColor = 'white';
      Chart.defaults.global.defaultFontSize = 15;
      document.getElementById("chartContainer").style.border = "5px dashed black";
      if (volunteersChart != null) {
        volunteersChart.destroy();
        volunteersChart = null;
      }
      volunteersChart = new Chart(activityChart, {
        type: 'bar',
        data: {
          labels: names,
          //labels: exLabels,
          datasets: [{
            label: 'Ore de voluntariat',
            backgroundColor: '#ffffff',
            data: hours
            //data: exHours
          },
          {
            label: 'Task-uri indeplinite si de facut',
            backgroundColor: '#32be8f',
            data: tasks
            //data: exTasks
          }]
        },
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                suggestedMin: 0
              }
            }]
          }
        }
      });

      if (exLabels.length > 0) {
        //addTable(exLabels, exHours, exTasks);
        document.getElementById("myDynamicTable").innerHTML = '';
        addTable(names, hours, tasks, hours_tasks, last_activity);
      }
      else { //ceva - un paragraf sau un text care spune ca nu avem date la acest call
      }
      yearBtn.removeAttribute("disabled");
      yearBtn.textContent = 'Ultimul an';

      let htmlBtn = document.getElementById("exportHTML");
      htmlBtn.addEventListener("click", downloadHTML);

      let csvBtn = document.getElementById("exportCSV");
      csvBtn.addEventListener("click", downloadCSV);

      let pdfBtn = document.getElementById("exportPDF");
      pdfBtn.addEventListener("click", function(){
         //downloadPDF(exLabels, exHours, exTasks, exAverage, exDates);
         downloadPDF(names, hours, tasks, hours_tasks, last_activity);
    });
    })
    .catch(function () {
      //error
    })

}

function downloadPDF(names, hours, tasks, hours_tasks, last_activity) {
  var canvas = document.querySelector('#activityChart');
  //creates image
  var canvasImg = canvas.toDataURL("image/jpeg", 1.0);

  //creates PDF from img
  var doc = new jsPDF();
  doc.setFontSize(20);
  doc.text(55, 20, 'Rapoarte - Fabrica de Voluntari');  

  doc.setDrawColor(0,0,0);
  doc.setLineWidth(1);
  doc.line(0, 25, 250, 25);
  doc.addImage(canvasImg, 'JPEG', 10, 30, 191, 100);
  doc.line(0, 135, 250, 135);

  var rows = [];
  for(var i=0; i<names.length; i++)
  {
    rows[i]=[names[i],hours[i],tasks[i],hours_tasks[i],last_activity[i]];
  }

  doc.autoTable({
    head: [['Nume si prenume', 'Ore adunate', 'Nr. task-uri', 'Medie ore/task', 'Ultima activitate']],
    body: rows,
    startY: 150,
    // Default for all columns
    tableWidth: 'wrap',
    styles: { halign: 'center' },
    headStyles: { fillcolor: [0, 0, 0]},
    pageBreak: 'auto',
    margin: {left : 33},
    // Override the default above for the text column
    columnStyles: { text: { cellWidth: 'auto' } }
  })
  
  //doc.text(50, 200, names[2]);
/* 
  doc.setLineWidth(0.5);
  doc.line(10, 140, 190, 140); //adaug cate 35 pe x si cate 10 pe y
  var x = 0;
  var y = 0;
  for (var i = 0; i <= names.length; i++) {
    for (var j = 0; j <= 4; j++) {
      x = 15+j*35;
      y = 143+i*10;
      if (i == 0 && j == 0) {
        doc.text(x, y, 'Nume si prenume');
      }
      else if (i == 0 && j == 1) {
        doc.text(x, y, 'Ore adunate');
      }
      else if (i == 0 && j == 2) {
        doc.text(x, y, 'Nr. task-uri');
      }
      else if (i == 0 && j == 3) {
        doc.text(x, y, 'Medie ore/task');
      }
      else if (i == 0 && j == 4) {
        doc.text(x, y, 'Ultima activitate');
      }
      else if (j == 0) {
        doc.text(x, y, names[i-1]);
      }
      else if (j == 1) {
        doc.text(x, y, hours[i-1]);
      }
      else if (j == 2) {
        doc.text(x, y, tasks[i-1]);
      }
      else if (j == 3) {
        doc.text(x, y, hours_tasks[i-1]);
      }
      else if (j == 4) {
        doc.text(x, y, last_activity[i-1]);
      }
      doc.line(10, 140+10*(j+1), 190, 140+10*(j+1));
    }
  } */
  doc.save('raportFDV.pdf');
}

//sursa: https://www.youtube.com/watch?v=cpHCv3gbPuk
function downloadCSV() {
  const dataTable = document.getElementById("myDynamicTable");
  const exporter = new TableCSVExporter(dataTable);
  const csvOutput = exporter.convertToCSV();
  const csvBlob = new Blob([csvOutput], { type: "text/csv" });
  const blobUrl = URL.createObjectURL(csvBlob);
  const anchorElement = document.createElement("a");

  anchorElement.href = blobUrl;
  anchorElement.download = "raportFDV.csv";
  anchorElement.click();

  setTimeout(() => {
    URL.revokeObjectURL(blobUrl);
  }, 500);
}

//sursa: https://stackoverflow.com/questions/22084698/how-to-export-source-content-within-div-to-text-html-file
function downloadHTML() {
  const myCanvas = document.querySelector("#activityChart");
  const dataURI = myCanvas.toDataURL();
  //imdConverted.src = dataURI;

  var elHtml = document.getElementById("myDynamicTable").innerHTML;
  var link = document.createElement('a');
  mimeType = 'text/plain';

  link.setAttribute('download', 'raportFDV.html');

  var b = "margin: 0px auto;";
  var position = 14;
  let table = elHtml.substring(0, position) + b + elHtml.substring(position);

  link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + '<div class="content" style="position: relative; display: flex; justify-content: center;"><div class="container" style="background-color: black; margin: 0 auto; position: absolute;"><div class="another" style="display: inline-block;"><img src="' + dataURI + '">' + '<br><br><br>' + encodeURIComponent(table) + '</div></div></div>');
  link.click();
  document.body.removeChild(link)
}

function addTable(lbs, hrs, tks, avghrs, lastDate) {
  var myTableDiv = document.getElementById("myDynamicTable");

  var table = document.createElement('TABLE');
  table.style.backgroundColor = 'white';
  table.style.border = '2px solid #38d39f';

  var tableBody = document.createElement('TBODY');
  table.appendChild(tableBody);

  for (var i = 0; i <= lbs.length; i++) {
    var tr = document.createElement('TR');
    tableBody.appendChild(tr);
    for (var j = 0; j <= 4; j++) {
      var td = document.createElement('TD');
      td.width = '150';
      if (i == 0 && j == 0) {
        td.appendChild(document.createTextNode("Nume si prenume"));
        td.style.textAlign = 'center';
      }
      else if (i == 0 && j == 1) {
        td.appendChild(document.createTextNode("Ore adunate"));
        td.style.textAlign = 'center';
      }
      else if (i == 0 && j == 2) {
        td.appendChild(document.createTextNode("Nr. task-uri"));
        td.style.textAlign = 'center';
      }
      else if (i == 0 && j == 3) {
        td.appendChild(document.createTextNode("Medie ore/task"));
        td.style.textAlign = 'center';
      }
      else if (i == 0 && j == 4) {
        td.appendChild(document.createTextNode("Ultima activitate"));
        td.style.textAlign = 'center';
      }
      else if (j == 0) {
        td.appendChild(document.createTextNode(lbs[i - 1]));
        td.style.textAlign = 'center';
      }
      else if (j == 1) {
        td.appendChild(document.createTextNode(hrs[i - 1]));
        td.style.textAlign = 'center';
      }
      else if (j == 2) {
        td.appendChild(document.createTextNode(tks[i - 1]));
        td.style.textAlign = 'center';
      }
      else if (j == 3) {
        td.appendChild(document.createTextNode(avghrs[i - 1]));
        td.style.textAlign = 'center';
      }
      else if (j == 4) {
        td.appendChild(document.createTextNode(lastDate[i - 1]));
        td.style.textAlign = 'center';
      }
      tr.appendChild(td);
    }
  }
  myTableDiv.appendChild(table);
}

class TableCSVExporter {
  constructor(table, includeHeaders = true) {
    this.table = table;
    this.rows = Array.from(table.querySelectorAll("tr"));

    if (!includeHeaders && this.rows[0].querySelectorAll("th").length) {
      this.rows.shift();
    }
  }

  convertToCSV() {
    const lines = [];
    const numCols = this._findLongestRowLength();

    for (const row of this.rows) {
      let line = "";

      for (let i = 0; i < numCols; i++) {
        if (row.children[i] !== undefined) {
          line += TableCSVExporter.parseCell(row.children[i]);
        }

        line += (i !== (numCols - 1)) ? "," : "";
      }

      lines.push(line);
    }

    return lines.join("\n");
  }

  _findLongestRowLength() {
    return this.rows.reduce((l, row) => row.childElementCount > l ? row.childElementCount : l, 0);
  }

  static parseCell(tableCell) {
    let parsedValue = tableCell.textContent;

    // Replace all double quotes with two double quotes
    parsedValue = parsedValue.replace(/"/g, `""`);

    // If value contains comma, new-line or double-quote, enclose in double quotes
    parsedValue = /[",\n]/.test(parsedValue) ? `"${parsedValue}"` : parsedValue;

    return parsedValue;
  }
}
