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
  //badges for hours worked and number of tasks
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
        })} //from here badges regarding the hours worked
        if (sumHoursWorked >= 1 && sumHoursWorked < 10 && (myBadges.includes('0LgHQQc9Q1miBpADl_OE6w') == 0)) {
          fetch('https://api.badgr.io/v2/badgeclasses/0LgHQQc9Q1miBpADl_OE6w/assertions', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Authorization': bearer
            },
            body: JSON.stringify(recipientPayload)
          })
        }
        if (sumHoursWorked >= 10 && sumHoursWorked < 100 && (myBadges.includes('azF6ho04QvyVv-qofLizEg') == 0)) {
          fetch('https://api.badgr.io/v2/badgeclasses/azF6ho04QvyVv-qofLizEg/assertions', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Authorization': bearer
            },
            body: JSON.stringify(recipientPayload)
          })
        }
        if (sumHoursWorked >= 100 && (myBadges.includes('srSOwZGTTo2y9hziUfin8w') == 0)) {
          fetch('https://api.badgr.io/v2/badgeclasses/srSOwZGTTo2y9hziUfin8w/assertions', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Authorization': bearer
            },
            body: JSON.stringify(recipientPayload)
          })}
    })
    //badges for number of ngos
    const myUrl = `/api/volunteers/${myID}/associations`;
  fetch(myUrl)
    .then(function (resp) {
      return resp.json();
    })
    .then(function (jsonResp) {
      console.log(jsonResp);
      var numberOfNGOs = jsonResp.length;

      if (numberOfNGOs >= 1 && numberOfNGOs < 5 && (myBadges.includes('Z4ms_ZQMSyitFbEdJsxOSw') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/Z4ms_ZQMSyitFbEdJsxOSw/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })
      }
      if (numberOfNGOs >= 5 && numberOfNGOs < 10 && (myBadges.includes('wGLztPSZQ2e3xW04PIxyxw') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/wGLztPSZQ2e3xW04PIxyxw/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })
      }
      if (numberOfNGOs >= 10 && (myBadges.includes('txhJHk48Qb2mTStRGVpwsA') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/txhJHk48Qb2mTStRGVpwsA/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })}
    })
    //badges regarding feedback
    const myLastUrl = `/api/volunteers/${myID}/ratings`;
  fetch(myLastUrl)
    .then(function (resp) {
      return resp.json();
    })
    .then(function (jsonResp) {
      console.log(jsonResp);
      var minGrade = 6;
      var maxGrade = -1;
      var grade = 0;
      for (var i = 0; i < jsonResp.length; i++) {
          grade = (parseFloat(jsonResp[i]['harnic']) + parseFloat(jsonResp[i]['comunicativ']) + parseFloat(jsonResp[i]['disponibil']) + parseFloat(jsonResp[i]['punctual']) + parseFloat(jsonResp[i]['serios']))/5;
          if(grade>maxGrade)
            maxGrade=grade;
          if(grade<minGrade)
            minGrade=grade;
      }

      if ((maxGrade==5) && (myBadges.includes('JZ5PB52MRKG4JXN1G_xt7Q') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/JZ5PB52MRKG4JXN1G_xt7Q/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })
      }
      if ((minGrade <= 2.5) && (myBadges.includes('gRh4mFl0QSWvu-8yS12KdA') == 0)) {
        fetch('https://api.badgr.io/v2/badgeclasses/gRh4mFl0QSWvu-8yS12KdA/assertions', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': bearer
          },
          body: JSON.stringify(recipientPayload)
        })
      }
    })
  setTimeout(() => { window.location.reload(); }, 3500);
}