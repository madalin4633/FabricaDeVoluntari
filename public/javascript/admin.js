function change_tab(evt, id) {

    var i, tabcontent;
  
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    document.getElementById(id).style.display = "block";
    evt.currentTarget.className += " active";
}

async function get_fetch(url = '', data = {}, method_used = 'GET') {
  // Default options are marked with *
  const response = await fetch(url, {
    method: method_used
    // body: JSON.stringify(data) 
  });
  return response.json();
}

async function postData(url = '', data = {}, method_used = 'GET') {
  // Default options are marked with *
  const response = await fetch(url, {
    method: method_used,
    body: data 
  });
  return response.json();
}

function showAddTaskForm(e) {
  let form = document.getElementById('add-task-' + e);

  form.style.display = "block";
}

let execBtn = document.getElementById("exec");

execBtn.addEventListener("click", fetch_route);

function fetch_route(){

  let routeInput = document.getElementById("input_route");

  let payloadInput = document.getElementById("input_payload");

  let methodInput = document.getElementById("method_selector");

  let resultOutput = document.getElementById("output");
  
  let route = routeInput.value;

  let payload = '' + payloadInput.value;

  let method = methodInput.value;

  if (method == 'get'){
    get_fetch(route, {}, method).then(data => {resultOutput.value = JSON.stringify(data, undefined, 4);});
  }
  else{
    postData(route, payload, method).then(data => {resultOutput.value = JSON.stringify(data, undefined, 4);});
  }
  

}