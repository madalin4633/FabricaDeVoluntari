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
    var bearer = 'Bearer ' + newA;
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
        for (i = 0; i < jsonResp['result'].length; i++) {
          var badgeImage = jsonResp['result'][i]['image'];
          var recipientEmail = jsonResp['result'][i]['recipient']['plaintextIdentity'];
        }
        document.getElementById('collapsible-profile').innerHTML = '<div class="awardBadge"><button id="awardBadgeBTN" type="button">Revendica BADGE-uri</button></div>';
        let awardBtn = document.getElementById("awardBadgeBTN");
        awardBtn.addEventListener("click", onClickAward);
      }))
  }).catch(function () {
    //error
  })

  