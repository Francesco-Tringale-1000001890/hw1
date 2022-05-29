<?php
 //avvia la sessione
 session_start();
 //elimino la sessione
 session_destroy();
 //andiamo alla login
 header("Location: login.php");
 exit;
?>