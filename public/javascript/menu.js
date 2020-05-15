function initMenu() {
    let coll = document.querySelectorAll(".notification button");

    for (i=0; i < coll.length; i++){
        coll[i].addEventListener("click", function() {
            this.parentNode.classList.toggle("closed");
        })
    }
}