function initCollapsible() {
    let coll = document.getElementsByClassName("collapsible-container");
    let i;

    for (i = 0; i < coll.length; i++){
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            let content = this.nextElementSibling;

            // toggle height on click
            if (!this.classList.contains("active")) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
    });

    // toggle height to inital class
    if (!coll[i].classList.contains("active")) {
        coll[i].nextElementSibling.style.maxHeight = null;
    } else {
        coll[i].nextElementSibling.style.maxHeight = coll[i].nextElementSibling.scrollHeight + "px";
    }

}
}

