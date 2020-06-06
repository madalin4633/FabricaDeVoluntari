// association add new task/project
function showAddTaskForm(e) {
    let form = document.getElementById('add-task-' + e);

    form.style.display = "block";
}

function assignTask(elem, task_id, vol_id, assoc_id) {
    let payload = {'volunteer_id':vol_id,
    'task_id': task_id,
    'association_id': assoc_id};
    
     fetch("/api/task/asign", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
     .then(function (resp) {
        console.log("a mers!");

        let activeContainer = document.getElementById("active-tasks");

        activeContainer.appendChild(elem.parentNode);
     })
     .catch(function () {
         console.log("a crapat!");
     })
}

function vol_markTaskDone(elem, task_id, vol_id, assoc_id) {
    let payload = {'volunteer_id':vol_id,
    'task_id': task_id,
    'association_id': assoc_id,
    'for_volunteer': true};

    fetch("/api/task/markcomplete", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
    .then(function (resp) {
        console.log("a mers!");

        let activeContainer = document.getElementById("active-tasks");


    })
    .catch(function () {
        console.log("a crapat!");
    })
}

function assoc_markTaskDone(elem, task_id) {
    let payload = {'volunteer_id':0,
    'task_id': task_id,
    'association_id': 0,
    'for_volunteer': false};

    fetch("/api/task/markcomplete", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
    .then(function (resp) {
        console.log("a mers!");

        let activeContainer = document.getElementById("active-tasks");


    })
    .catch(function () {
        console.log("a crapat!");
    })
}