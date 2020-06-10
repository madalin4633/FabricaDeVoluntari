let overlay = document.getElementById('feedback-form-overlay');
let score = {harnic: 0, comunicativ: 0, disponibil: 0, punctual: 0, serios: 0};

overlay.addEventListener('click', function(event) {
    event.target.isEqualNode(overlay) && overlay.classList.remove('open');
});

function updateFeedbackStar(elem) {
    let allStars = elem.parentNode.querySelectorAll('.feedback-star');

    allStars.forEach(element => {
        element.classList.remove('selected');
    });

    elem.classList.add('selected');
    let metric = elem.parentNode.querySelector('.metric-name').textContent;

    score[metric] = parseInt(elem.getAttribute('data-star'));
}

function showFeedbackForm(elem, task_id, forVolunteer, volassoc_id, vol_id, vol_pic='', vol_initials='') {

    score = {harnic: 0, comunicativ: 0, disponibil: 0, punctual: 0, serios: 0};
    
    let allStars = document.getElementById('feedback-form-container').querySelectorAll('.feedback-star');
    allStars.forEach(element => {
        element.classList.remove('selected');
    });

    // get details
    let taskContainer = document.querySelector("[data-task-id='task-" + task_id + "']" )
    let title = taskContainer.querySelector('.activity-title').textContent;

    let projectContainer = taskContainer.parentNode;
    if (forVolunteer) {
        projectContainer = taskContainer.parentNode.parentNode;
        document.getElementById('feedback-form-container').classList.add('show-stars');
    }

    let projectBanner = projectContainer.querySelector('.project-banner').cloneNode(true);
    projectBanner.removeChild(projectBanner.querySelector('.project-details'));

    let taskTitleNode = document.getElementById('feedback-form-task');
    taskTitleNode.textContent = 'TASK: ' + title;
    taskTitleNode.setAttribute('data-task-id', task_id);
    
    let projectTitleNode = document.getElementById('feedback-form-title');
    projectTitleNode.textContent = projectBanner.textContent;
 
    let profilePic = overlay.querySelector('.feedback-assoc-icon');
    if (vol_pic != '') {
        profilePic.style.backgroundImage = 'url("/public/images/profile-pics/' + vol_pic + '")';
        profilePic.textContent = "";
        profilePic.style.display = "block";

    } else if (vol_initials != '') {
        profilePic.style.display = "block";
        profilePic.style.backgroundColor = 'burlywood';
        profilePic.style.backgroundPosition = 'center';
        profilePic.style.backgroundImage = "";
        profilePic.textContent = vol_initials;
    }

    // let overlay = document.getElementById('feedback-form-overlay');
    overlay.classList.add('open');

    let btnGiveFeedback = document.getElementById('btnGiveFeedback');
    btnGiveFeedback.addEventListener('click', function() {
        giveFeedback(elem.parentNode.parentNode, task_id, forVolunteer, volassoc_id, vol_id, 
                score['harnic'], score['comunicativ'], score['disponibil'], score['punctual'], score['serios']);
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