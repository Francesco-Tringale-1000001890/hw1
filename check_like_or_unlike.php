<?php
  require_once 'dbconfig.php';
  session_start();
  //controlliamo se è già stato messo o no il like
  if(isset($_POST['id']) && isset($_POST['indice'])){
  $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
  
  $comic_id=mysqli_real_escape_string($conn, $_POST['id']); //prendo il valore del titolo
  $comic_indice=mysqli_real_escape_string($conn, $_POST['indice']);
  $username_sessione=$_SESSION['username'];
  /*facciamo un join, se ci vengono restituiti risultati allora cerchiamo l'id di quel comic, se non ci vengono restituiti risultati allora vuol dire che è 
    la prima volta che questo
    account entra/cerca quel personaggio o che non gli ha messo like */
    $query="SELECT likes.id_comic
    FROM iscritto JOIN likes ON iscritto.username=likes.username_utente JOIN comics ON comics.id=likes.id_comic
    WHERE iscritto.username='".$username_sessione."' AND comics.id='".$comic_id."'" ;
    $resquery=mysqli_query($conn, $query);
    if(mysqli_num_rows($resquery)>0){ //se ho dei risultati dalla query
        $response=array("like"=> true, "indice"=> $comic_indice); //ho già messo mi piace in precedenza
   }
   else{
        $response=array("like"=> false, "indice"=> $comic_indice); //o è la prima volta che questo account entra/cerca quel personaggio o che non gli ha messo like 
        
   }
   echo json_encode($response); 
   mysqli_close($conn); 
  }
?>