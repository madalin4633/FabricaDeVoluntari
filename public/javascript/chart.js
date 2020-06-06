let volunteersChart = null;

let weekBtn = document.getElementById("LastWeek");
weekBtn.addEventListener("click", onClickWeek);

let monthBtn = document.getElementById("LastMonth");
monthBtn.addEventListener("click", onClickMonth);

let yearBtn = document.getElementById("LastYear");
yearBtn.addEventListener("click", onClickYear);

function onClickWeek() {
  weekBtn.setAttribute("disabled", true);
  weekBtn.textContent = 'Se incarca...';
  var exLabels = ['marculeeeee sadlfknasd', 'asdfasdfasd asfdasf', 'asdfasdf aherje', 'ahahre reh eh', 'erheraerh erh', 'aerhaeryaery', 'asdgas asdg', 'a23a23ta23tagd', 'a23ya23y a'];
  var exHours = [23, 12, 23, 5, 15, 0, 5, 6, 2];
  var exTasks = [1, 5, 6, 7, 2, 3, 1, 1, 1];

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

      document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

      let activityChart = document.getElementById('activityChart').getContext('2d');
      Chart.defaults.global.defaultFontColor = 'white';
      Chart.defaults.global.defaultFontSize = 15;
      document.getElementById("chartContainer").style.border = "5px dashed black";
      if(volunteersChart!=null)
      {
        volunteersChart.destroy();
        volunteersChart=null;
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

      if (exLabels.length > 0) {
        //addTable(exLabels, exHours, exTasks);
        addTable(names, hours, tasks);
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
      pdfBtn.addEventListener("click", downloadPDF);
    })
    .catch(function () {
      //error
    })

}

function onClickMonth() {
  monthBtn.setAttribute("disabled", true);
  monthBtn.textContent = 'Se incarca...';
  var exLabels = ['asdfasdf aherje', 'ahahre reh eh', 'erheraerh erh', 'aerhaeryaery', 'asdgas asdg', 'a23a23ta23tagd', 'a23ya23y a'];
  var exHours = [23, 5, 15, 0, 5, 6, 2];
  var exTasks = [6, 7, 2, 3, 1, 1, 1];

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

      document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

      let activityChart = document.getElementById('activityChart').getContext('2d');
      Chart.defaults.global.defaultFontColor = 'white';
      Chart.defaults.global.defaultFontSize = 15;
      document.getElementById("chartContainer").style.border = "5px dashed black";
      if(volunteersChart!=null)
      {
        volunteersChart.destroy();
        volunteersChart=null;
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

      if (exLabels.length > 0) {
        //addTable(exLabels, exHours, exTasks);
        addTable(names, hours, tasks);
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
      pdfBtn.addEventListener("click", downloadPDF);
    })
    .catch(function () {
      //error
    })

}

function onClickYear() {
  yearBtn.setAttribute("disabled", true);
  yearBtn.textContent = 'Se incarca...';
  var exLabels = ['asdfasdf aherje', 'aerhaeryaery', 'asdgas asdg', 'a23a23ta23tagd', 'a23ya23y a'];
  var exHours = [15, 0, 5, 6, 2];
  var exTasks = [2, 3, 1, 1, 1];

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

      document.getElementById('exportContainer').innerHTML = '<h3>Salveaza rapoartele grafice si numerice</h3><div class="exportContainer"><button id="exportHTML" type="button">Export HTML</button><button id="exportCSV" type="button">Export CSV</button><button id="exportPDF" type="button">Export PDF</button></div>';

      let activityChart = document.getElementById('activityChart').getContext('2d');
      Chart.defaults.global.defaultFontColor = 'white';
      Chart.defaults.global.defaultFontSize = 15;
      document.getElementById("chartContainer").style.border = "5px dashed black";
      if(volunteersChart!=null)
      {
        volunteersChart.destroy();
        volunteersChart=null;
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

      if (exLabels.length > 0) {
        //addTable(exLabels, exHours, exTasks);
        addTable(names, hours, tasks);
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
      pdfBtn.addEventListener("click", downloadPDF);
    })
    .catch(function () {
      //error
    })

}

function downloadPDF() {
  var canvas = document.querySelector('#activityChart');
  //creates image
  var canvasImg = canvas.toDataURL("image/jpeg", 1.0);

  //creates PDF from img
  var doc = new jsPDF('landscape');
  doc.setFontSize(20);
  doc.text(15, 15, "Cool Chart");
  doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150);
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
  var elHtml = document.getElementById("export").innerHTML;
  var link = document.createElement('a');
  mimeType = 'text/plain';

  link.setAttribute('download', 'raportFDV.html');
  link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
  link.click();
  document.body.removeChild(link)
}

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
      else if (j == 0)
        td.appendChild(document.createTextNode(lbs[i - 1]));
      else if (j == 1) {
        td.appendChild(document.createTextNode(hrs[i - 1]));
        td.style.textAlign = 'center';
      }
      else if (j == 2) {
        td.appendChild(document.createTextNode(tks[i - 1]));
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
