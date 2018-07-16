<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anspire Orders</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- <a class="navbar-brand" href="#">Home</a> -->
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><?php echo anchor("Auth/logout/", 'Logout') ;?></a></li>
              <li><?php echo anchor("Orders/add/", 'Place an order') ;?></a></li>
            </ul>
          </li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <h1><?php echo "Orders";?></h1>
  <div id="infoMessage"><?php echo $this->session->flashdata('message');?></div>

  </p>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>
  function doconfirm() {
    job = confirm("Are you sure to delete permanently?");
    if (job != true) {
      return false;
    }
  }
  </script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <div class="span12 field-box">
      <label>Order:</label>
      <input name="order" class="span6" type="text"/>
  </div>

  <p><input type="button" onclick="update()" value="place an order"></p>
  <h1 id="orders"></h1>

  <table id="gadwal" class="table">
    <thead>
    <tr>
      <th>order</th>
      <th>ordered_by</th>
      <th>status</th>
      <th>Action</th>
      <th>time created</th>

    </tr>
  </thead>
    <tbody></tbody>
  </table>

  <script src="https://www.gstatic.com/firebasejs/5.2.0/firebase.js"></script>
  <script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyB5jlen5565tE2pe_I56ouK4u98hET1jr0",
    authDomain: "test-cbee9.firebaseapp.com",
    databaseURL: "https://test-cbee9.firebaseio.com",
    projectId: "test-cbee9",
    storageBucket: "test-cbee9.appspot.com",
    messagingSenderId: "403865828003"
  };
  firebase.initializeApp(config);
  const auth=firebase.auth();
  const promise=auth.signInWithEmailAndPassword("ismail.elshaarawy@gmail.com","eesso5490");
  promise.catch(e => console.log(e.message));
  // var orders=document.getElementById('orders');
  // var dbRef=firebase.database().ref('doctros_eng');
  //dbRef.on('value',snap=>orders.innerText=snap.val().messageText);
  firebase.database().ref('/orders').on('value', function(snapshot) {
    var array=[];
    array=snapshotToArray(snapshot);
    // orders.innerText="";
    $("#gadwal tbody").empty();
    array.forEach(function(entry) {
      // orders.innerText+=entry.order+" "+entry.status+" "+entry.ordered_by;
      // orders.innerHTML+="<br>";
      $("#gadwal tbody").prepend("<tr><td>"+entry.order+"</td><td>"+entry.ordered_by+"</td><td>"+entry.status+"</td><td><input type='button' onclick=update('"+entry.key+"') value='تمام'/></td></tr>");
    });


  });

  // function update(id){
  // var newPostKey = firebase.database().ref().child('orders').push().key;
  // var postData = {
  //   order: "username",
  //   ordered_by: "random",
  //   status: "pending"
  // };
  // var updates = {};
  // updates['/orders/' + newPostKey] = postData;
  // return firebase.database().ref().update(updates);
  // }

  function update(id){
    var order="";
    var ordered_by="";
    return firebase.database().ref('/orders/' + id).once('value').then(function(snapshot) {
      order = snapshot.val().order;
      ordered_by = snapshot.val().ordered_by;
      var postData = {
        order: order,
        ordered_by: ordered_by,
        status: "done"
      };

      // Write the new post's data simultaneously in the posts list and the user's post list.
      var updates = {};
      updates['/orders/' + id] = postData;

      return firebase.database().ref().update(updates);
      // ...
    });
  }
  function snapshotToArray(snapshot) {
    var returnArr = [];

    snapshot.forEach(function(childSnapshot) {
      var item = childSnapshot.val();
      item.key = childSnapshot.key;

      returnArr.push(item);
    });

    return returnArr;
  };
</script>
</body>
</html>


<!-- {
"rules": {
".read": "auth != null",
".write": "auth != null"
}
} -->
