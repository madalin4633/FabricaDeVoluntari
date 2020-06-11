var details = {
  'grant_type': 'refresh_token',
  'refresh_token': refresh_token
};

var formBody = [];
for (var property in details) {
  var encodedKey = encodeURIComponent(property);
  var encodedValue = encodeURIComponent(details[property]);
  formBody.push(encodedKey + "=" + encodedValue);
}
formBody = formBody.join("&");

fetch('https://api.badgr.io/o/token', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
  },
  body: formBody
}).then(function (resp) {
  return resp.json();
})
  .then(function (jsonResp) {
    //console.log(jsonResp);

    var newA = jsonResp['access_token'];
    var newR = jsonResp['refresh_token'];
    bearer = 'Bearer ' + newA;
    var myAPIbody = {
      "access_token": newA,
      "refresh_token": newR
    };
    fetch('/api/badger/refresh/token', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(myAPIbody)
    }).then(fetch('https://api.badgr.io/v2/issuers/MRBkV45xTrWRWtjjyaIHKA/assertions', {
      method: 'GET',
      headers: {
        'Authorization': bearer
      }
    })
      .then(function (resp) {
        return resp.json();
      })
      .then(function (jsonResp) {
        var i;
        myBadges = [];
        for (i = 0; i < jsonResp['result'].length; i++) {
          var badgeImage = jsonResp['result'][i]['image'];
          var recipientEmail = jsonResp['result'][i]['recipient']['plaintextIdentity'];

          if (recipientEmail === email) {
            myBadges.push(jsonResp['result'][i]['badgeclass']);
            var img = document.createElement("img");
            img.src = badgeImage;
            var slider = document.getElementsByClassName("slider")[0];
            slider.insertBefore(img, document.getElementsByClassName("prev")[0]);
          }
        }
        document.getElementById('collapsible-profile').innerHTML = '<div class="awardBadge"><button id="awardBadgeBTN" type="button">Revendica BADGE-uri</button></div>';
        let awardBtn = document.getElementById("awardBadgeBTN");
        awardBtn.addEventListener("click", function () {
          onClickAward(myBadges, bearer);
        });
      }))
  }).catch(function () {
    //error
  })
function onClickAward(myBadges, bearer) {
  var recipientPayload = {
    "recipient": {
      "identity": email,
      "type": "email",
      "hashed": false
    }
  };
  if (myBadges.includes('Pvn4nvyWThOOX5vYM6XR5A') == 0) { //badge for having an account
    fetch('https://api.badgr.io/v2/badgeclasses/Pvn4nvyWThOOX5vYM6XR5A/assertions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': bearer
      },
      body: JSON.stringify(recipientPayload)
    })
  }
  //if(myBadges.includes('8RDDeQwXRHeiPszXa4Qijw')==0) - prima asociatie
  const myNaiveUrl = `/api/volunteers/${myID}/tasks`;
  fetch(myNaiveUrl)
    .then(function (resp) {
      return resp.json();
    })
    .then(function (jsonResp) {
      console.log(jsonResp);
      var sumHoursWorked = 0;
      var doneTasksIDs = 0;
      for (var i = 0; i < jsonResp.length; i++) {
        if (jsonResp[i]['done'] === 't') {
          sumHoursWorked = parseFloat(jsonResp[i]['hours_worked']) + sumHoursWorked;
          doneTasksIDs++;
        }
      }
      if (doneTasksIDs >= 1 && doneTasksIDs < 10 && (myBadges.includes('8RDDeQwXRHeiPszXa4Qijw') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/8RDDeQwXRHeiPszXa4Qijw/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })
      }
      if (doneTasksIDs >= 10 && doneTasksIDs < 25 && (myBadges.includes('0ZBowD-EQ_CCX1drkt3Y0A') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/0ZBowD-EQ_CCX1drkt3Y0A/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })
      }
      if (doneTasksIDs >= 25 && (myBadges.includes('RQLAyFO3Rzyq8JcEZac9IQ') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/RQLAyFO3Rzyq8JcEZac9IQ/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })}
    })
  //window.location.reload();
}