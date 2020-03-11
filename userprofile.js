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
