<html> 

<head> 
<title>Admin</title>

<style rel="stylesheet" type="text/css" media="all">

.centered {
  background-image: url(img/trans5x5.png);
  background-repeat: repeat;
  border-color: #353d6b;
  border-width: 1px;
  border-style: solid;
  position: fixed;
  top: 50%;
  left: 50%;
  margin-top: -200px;
  margin-left: -200px;
}

body {
	padding: 0px;
	margin: 0px;
	font-size: 15px;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	text-align: center;
	background-image: url(img/mountain-bg.jpg);
	background-repeat: no-repeat;
}

</style>

</head>

<body bgcolor="white" text="black">

<div class="centered">
<h1>Login</h1>
<table width="250" cellpadding="10">
<tr>
<td>
<form action="checkuser.php" method="post">

<label>Enter E-mail <input id="email" name="email_address" size="35"></label><br>

<label>Password <input id="password" name="password" type="password" size="35"></label><br>

<input type="submit" value="Login">

</form>
</td>
</tr>
</table>
</div>

</body>

</html>