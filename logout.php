<?php 
session_start();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
header("Location: login_register.php");        // you can enter home page here ( Eg : header("Location: " ."http://www.krizna.com"); 
?>
