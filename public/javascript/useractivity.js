// association add new task/project
function showAddTaskForm(e) {
    let form = document.getElementById('add-task-' + e);

    form.style.display = "block";
}

function assignTask(elem, task_id, vol_id, assoc_id) {
    // start spinner
    let spinner = elem.parentNode.querySelector('.sk-chase-container');
    spinner.style.display = "flex";

    let payload = {'volunteer_id':vol_id,
    'task_id': task_id,
    'association_id': assoc_id};
    
     fetch("/api/task/asign", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
     .then(function (resp) {
            let activeTasksContainer = document.getElementById("active-tasks");
            let projContainer = elem.parentNode.parentNode;
            proj_id = projContainer.getAttribute("data-proj-id");
        
            spinner.style.display = "none";
        
            // look for project in active tasks container
            let activeProject = activeTasksContainer.querySelector("[data-proj-id='" + proj_id + "']");
            if (activeProject == null) {
                // clone project container
                let clonedProject = projContainer.cloneNode(true);
        
                // remove all other tasks from cloned project
                let allOtherTasks = clonedProject.querySelectorAll(".activity-task:not([data-task-id='task-" + task_id + "'])");
                for (let xi=allOtherTasks.length-1; xi>=0; xi--)
                    allOtherTasks[xi].remove();
        
                // append in active container
                activeTasksContainer.appendChild(clonedProject);
                elem.parentNode.remove();
            }
            else
            {
                // only copy the task
                activeProject.appendChild(elem.parentNode);
            }
        
            // remove project from New Tasks if empty
            let newTasksLeft = projContainer.querySelector('.activity-task');
            if (newTasksLeft == null)
                projContainer.remove();
        
            // update container height
            activeTasksContainer.style.maxHeight = activeTasksContainer.scrollHeight + "px";

         })
     .catch(function () {
         console.log("a crapat!");
         spinner.style.display = "none";
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