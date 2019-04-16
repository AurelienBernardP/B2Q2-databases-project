<?php
    session_start();
    $log = $_SESSION['login'];
    $pass= $_SESSION['pass'];
    $db = new PDO("mysql:host=ms800.montefiore.ulg.ac.be; dbname=group14", $log, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 ?>
