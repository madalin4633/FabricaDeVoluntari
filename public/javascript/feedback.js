function hideFeedbackForm(overlay) {
    overlay.style.display="none";
}

function showFeedbackForm(elem, task_id) {
    // get details
    let taskContainer = document.querySelector("[data-task-id='task-" + task_id + "']" )
    let title = taskContainer.querySelector('.activity-title').textContent;
    let projectBanner = taskContainer.parentNode.querySelector('.project-banner').cloneNode(true);
    projectBanner.removeChild(projectBanner.querySelector('.project-details'));
    let project=projectBanner.textContent;

    for (let node in projectBanner) {
        if (node.nodeType == Node.TEXT_NODE) {
            project = node.textContent;
        }
    }

    document.getElementById('feedback-form-title').textContent = project;
    document.getElementById('feedback-form-task').textContent = 'TASK: ' + title;
    
    let overlay = document.getElementById('feedback-form-overlay');
    overlay.style.display="flex";


}