function showSomething(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("customli").innerHTML =  this.responseText;
        }
    };
    xmlhttp.open("GET", "userprofile.php", true);
    xmlhttp.send();
    document.getElementById("customli").innerHTML = str;
    return str;
}

function initCollapsible() {
    var coll = document.getElementsByClassName("collapsible-container");
    var i;

    for (i = 0; i < coll.length; i++){
        coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}
}