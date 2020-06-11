let enableBtn = document.getElementById("enable");
let disableBtn = document.getElementById("disable");

let copyBtn = document.getElementById("copy");

let linkLabel = document.getElementById("link_label");

enableBtn.addEventListener("click", enable_recruitments);
disableBtn.addEventListener("click", disable_recruitments);
copyBtn.addEventListener("click", copy_link);

async function postData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
      method: 'PUT', 
      mode: 'cors', 
      cache: 'no-cache', 
      credentials: 'same-origin', 
      headers: {
        'Content-Type': 'application/json'
      },
      redirect: 'follow',
      referrerPolicy: 'no-referrer',
      body: JSON.stringify(data) 
    });
    return response.json();
  }


function enable_recruitments() {
    enableBtn.setAttribute("disabled", true);

    const myNaiveUrl = '/api/association/' + assoc_id + '/recruitments/enable';

    console.log(myNaiveUrl);

    postData(myNaiveUrl, {}).then(data => {linkLabel.value = data['code'];});

    disableBtn.removeAttribute("disabled");
    copyBtn.removeAttribute("disabled");
}

function disable_recruitments() {
    disableBtn.setAttribute("disabled", true);
    copyBtn.setAttribute("disabled", true);
    // disableBtn.value = 'Loading...';

    enableBtn.setAttribute("disabled", false);    

    linkLabel.value = "disabled";

    const myNaiveUrl = '/api/association/' + assoc_id + '/recruitments/disable';

    console.log(myNaiveUrl);

    postData(myNaiveUrl, {}).then(data => {console.log(data);});

    enableBtn.removeAttribute("disabled");
}

function copy_link() {
  
    var copyText = document.getElementById("link_label");

    copyText.select();

    copyText.setSelectionRange(0, 99999);
  
    document.execCommand("copy");
  
    alert("Copied the text: " + copyText.value);
  }