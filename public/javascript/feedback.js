let overlay = document.getElementById('feedback-form-overlay');

overlay.addEventListener('click', function(event) {
    event.target.isEqualNode(overlay) && overlay.classList.remove('open');
});

function showFeedbackForm(elem, task_id, isVolunteer, volassoc_id, vol_id) {
    // get details
    let taskContainer = document.querySelector("[data-task-id='task-" + task_id + "']" )
    let title = taskContainer.querySelector('.activity-title').textContent;
    let projectBanner = taskContainer.parentNode.querySelector('.project-banner').cloneNode(true);
    projectBanner.removeChild(projectBanner.querySelector('.project-details'));

    let taskTitleNode = document.getElementById('feedback-form-task');
    taskTitleNode.textContent = 'TASK: ' + title;
    taskTitleNode.setAttribute('data-task-id', task_id);
    
    let overlay = document.getElementById('feedback-form-overlay');
    overlay.classList.add('open');

    let btnGiveFeedback = document.getElementById('btnGiveFeedback');
    btnGiveFeedback.addEventListener('click', function() {
        giveFeedback(elem.parentNode.parentNode, task_id, isVolunteer, volassoc_id, vol_id,0,0,0,0,0);
    })  
}

function giveFeedback(taskContainer, task_id, forVolunteer, volassoc_id, vol_id, harnic, comunicativ, disponibil, punctual, serios) {
    let spinnerContainer = document.getElementById('feedback-form-container');

    // start spinner
    if (!spinnerContainer.classList.contains("pending"))
    spinnerContainer.classList.add("pending");

        let feedbackNotes = document.getElementById('feedback-notes');

    let payload = {'task_id': task_id,
                'volassoc_id': volassoc_id,
                'harnic': harnic,
                'comunicativ': comunicativ,
                'disponibil': disponibil,
                'punctual': punctual,
                'serios': serios,
                'descriere': feedbackNotes.value,
                'for_volunteer': forVolunteer
        }
    
    fetch("/api/volunteers/" + vol_id + "/tasks/" + task_id + "/ratings", {method:'PUT',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)})
    .then(function(resp) {
        console.log('a mers ' + resp);
 
        // stop spinner
        if (spinnerContainer.classList.contains("pending"))
        spinnerContainer.classList.remove("pending");

        feedbackNotes.value = "";
        overlay.classList.remove('open');
        taskContainer.classList.remove('need-feedback');
    })
    .catch(function(error) {
        console.log('a crapat ' + error)
 
        // stop spinner
        if (spinnerContainer.classList.contains("pending"))
        spinnerContainer.classList.remove("pending");
    })
}