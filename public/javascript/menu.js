let logoutBtn = document.getElementById("logout-btn");

logoutBtn.addEventListener("click", logout);

function logout() {
    console.log ("logout");
}


function initMenu() {
    let coll = document.querySelectorAll(".notification button");

    // close notification
    for (i=0; i < coll.length; i++){
        coll[i].addEventListener("click", function() {
            this.parentNode.classList.toggle("closed");
        })
    }

    //collape menu
    let menuBtn = document.getElementById("menu-icon");
    let vertMenu = document.querySelector(".menu>.vertical-menu");
    let menu = document.querySelector(".menu");
    
    menuBtn.addEventListener("click", function() {
        menu.classList.toggle("collapsed");
        vertMenu.classList.toggle("collapsed");
    })
}

function initCollapsible() {
    let coll = document.getElementsByClassName("collapsible-container");
    let i;

    for (i = 0; i < coll.length; i++){
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            let content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}
}


