<!DOCTYPE html>
<html>

<head>
		<link type="text/css" rel="stylesheet" href="css/main.css" />
    <title>AirBnB</title>
</head>

<ul>
    <li><a class="active" href="index.html">Home</a></li>
    <li><a href="login.html">Login</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#about">About</a></li>
</ul>

<h2>Login Form</h2>

<!--<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>-->


<form action="/action_page.php">
  <div class="imgcontainer">
    <img src="img\img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
    <input type="checkbox" checked="checked"> Remember me
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>


</body>
</html>
