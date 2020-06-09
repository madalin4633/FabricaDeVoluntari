function openCity(evt, id) {

    var i, tabcontent;
  
    tabcontent = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    document.getElementById(id).style.display = "block";
    evt.currentTarget.className += " active";
}

function showAddTaskForm(e) {
  let form = document.getElementById('add-task-' + e);

  form.style.display = "block";
}
