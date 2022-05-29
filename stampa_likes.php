<?php
  require_once 'dbconfig.php';
  session_start();
  $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
  $username_sessione=$_SESSION["username"];
  $comics_username_sessione=array();
  $query="SELECT comics.id, comics.nome, comics.price, comics.immagine
  FROM iscritto JOIN likes ON iscritto.username=likes.username_utente JOIN comics ON comics.id=likes.id_comic
  WHERE iscritto.username='".$username_sessione."'" ;
  $resquery=mysqli_query($conn, $query);
  while ($row=mysqli_fetch_assoc($resquery)) {//leggiamo i risultati
         
    $comics_username_sessione[]=$row; //metto tutto in un array
    
}
  echo json_encode($comics_username_sessione);
  mysqli_close($conn);
  
?>