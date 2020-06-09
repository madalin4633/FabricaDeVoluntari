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

      var myAPIbody = {
        "access_token" : newA,
        "refresh_token" : newR
      };
      console.log(myAPIbody);
      fetch('/api/badger/refresh/token', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(myAPIbody)
      });
  }).catch(function () {
    //error
  })
