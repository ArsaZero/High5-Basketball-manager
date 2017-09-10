<?php
   session_start();
   unset($_SESSION["username"]);
   
   header('location: High5_login/High5_login.php');
?>