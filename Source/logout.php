<?php

session_start();

unset($_SESSION['login']);
unset($_SESSION['pass']);
session_unset();
?>

<html>
<header>
<title> Logout </title>
</header>
<html>
<body>
<center>
<h1> Thank you for using our Application! <h1>
</center>
</body>
</html>
