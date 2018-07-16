<h1><?php echo "Place an order.";?></h1>
<div id="infoMessage"><?php if(isset($message)){echo $message;}?></div>


<div class="span12 field-box">
    <label>Order:</label>
    <input name="order" class="span6" type="text"/>
</div>

<p><input type="button" onclick="update()"></p>



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
function update(){
var newPostKey = firebase.database().ref().child('orders').push().key;
var postData = {
  order: "username",
  ordered_by: "random",
  status: "pending"
};
var updates = {};
updates['/orders/' + newPostKey] = postData;
return firebase.database().ref().update(updates);
}
</script>
