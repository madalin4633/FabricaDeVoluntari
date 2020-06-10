// association add new task/project
function showAddTaskForm(e) {
    let form = document.getElementById('add-task-' + e);

    form.style.display = "block";
}

function assignTask(elem, task_id, vol_id, assoc_id) {
    let taskContainer = elem.parentNode.parentNode;

    // start spinner
    if (!taskContainer.classList.contains("pending"))
        taskContainer.classList.add("pending");

    let payload = {'volunteer_id':vol_id,
    'task_id': task_id,
    'association_id': assoc_id};
    
     fetch("/api/task/asign", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
     .then(function (resp) {
            let activeTasksContainer = document.getElementById("active-tasks");
            let projContainer = taskContainer.parentNode;
            proj_id = projContainer.getAttribute("data-proj-id");
        
            // stop spinner
            if (taskContainer.classList.contains("pending"))
            taskContainer.classList.remove("pending");
        
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
                taskContainer.remove();
            }
            else
            {
                // only copy the task
                activeProject.appendChild(taskContainer);
            }
        
            // remove project from New Tasks if empty
            let newTasksLeft = projContainer.querySelector('.activity-task');
            if (newTasksLeft == null)
                projContainer.remove();
        
            // update container height
            activeTasksContainer.style.maxHeight = activeTasksContainer.scrollHeight + "px";

            // update container count
            let newTasksHeader = document.getElementById("new-tasks-header");
            let activeTasksHeader = document.getElementById("active-tasks-header");
            newTasksHeader.setAttribute("data-count", parseInt(newTasksHeader.getAttribute("data-count")) - 1);
            activeTasksHeader.setAttribute("data-count", parseInt(activeTasksHeader.getAttribute("data-count")) + 1);

            newTasksHeader.innerText = "New Tasks (" + newTasksHeader.getAttribute("data-count") + ")";
            activeTasksHeader.innerText = "Active Tasks (" + activeTasksHeader.getAttribute("data-count") + ")";
         })
     .catch(function (error) {
         console.log("a crapat! " + error);

            // stop spinner
            if (taskContainer.classList.contains("pending"))
            taskContainer.classList.remove("pending");
        })
}

function vol_markTaskDone(elem, task_id, vol_id, assoc_id) {
    let taskContainer = elem.parentNode.parentNode;

    // start spinner
    if (!taskContainer.classList.contains("pending"))
        taskContainer.classList.add("pending");

    let payload = {'volunteer_id':vol_id,
    'task_id': task_id,
    'association_id': assoc_id,
    'for_volunteer': true};

    fetch("/api/task/markcomplete", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
     .then(function (resp) {
            let completedTasksContainer = document.getElementById("completed-tasks-container");
            let projContainer = taskContainer.parentNode;
            proj_id = projContainer.getAttribute("data-proj-id");
        
            // stop spinner
            if (taskContainer.classList.contains("pending"))
            taskContainer.classList.remove("pending");
            
            // look for project in completed tasks container
            let completedProject = completedTasksContainer.querySelector("[data-proj-id='" + proj_id + "']");
            if (completedProject == null) {
                // clone project container
                let clonedProject = projContainer.cloneNode(true);
        
                // remove all other tasks from cloned project
                let allOtherTasks = clonedProject.querySelectorAll(".activity-task:not([data-task-id='task-" + task_id + "'])");
                for (let xi=allOtherTasks.length-1; xi>=0; xi--)
                    allOtherTasks[xi].remove();
        
                // append in active container
                completedTasksContainer.appendChild(clonedProject);
                taskContainer.remove();
            }
            else
            {
                // only copy the task
                completedProject.appendChild(taskContainer);
            }
        
            // remove project from New Tasks if empty
            let newTasksLeft = projContainer.querySelector('.activity-task');
            if (newTasksLeft == null)
                projContainer.remove();
        
            // update container height
            completedTasksContainer.style.maxHeight = completedTasksContainer.scrollHeight + "px";

            // update container count
            let completedTasksHeader = document.getElementById("completed-tasks-header");
            let activeTasksHeader = document.getElementById("active-tasks-header");
            completedTasksHeader.setAttribute("data-count", parseInt(completedTasksHeader.getAttribute("data-count")) + 1);
            activeTasksHeader.setAttribute("data-count", parseInt(activeTasksHeader.getAttribute("data-count")) - 1);

            completedTasksHeader.innerText = "Completed Tasks (" + completedTasksHeader.getAttribute("data-count") + ")";
            activeTasksHeader.innerText = "Active Tasks (" + activeTasksHeader.getAttribute("data-count") + ")";
         })
     .catch(function (error) {
         console.log("a crapat! " + error);
        //  stop spinner
        if (taskContainer.classList.contains("pending"))
        taskContainer.classList.remove("pending");
    })
}

function assoc_markTaskDone(elem, task_id, vol_id, assoc_id) {
    let taskContainer = elem.parentNode.parentNode;

    // start spinner
    if (!taskContainer.classList.contains("pending"))
        taskContainer.classList.add("pending");

    let payload = {'volunteer_id':vol_id,
    'task_id': task_id,
    'association_id': assoc_id,
    'for_volunteer': false};

    fetch("/api/task/markcomplete", {method: 'PUT', 
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
     .then(function (resp) {
            let projectContainer = taskContainer.parentNode.parentNode.querySelector(".completed-tasks");
        
            projectContainer.appendChild(taskContainer);
 
            // stop spinner
            if (taskContainer.classList.contains("pending"))
            taskContainer.classList.remove("pending");
            
         })
     .catch(function (error) {
         console.log("a crapat! " + error);
        //  stop spinner
        if (taskContainer.classList.contains("pending"))
        taskContainer.classList.remove("pending");
    })
}