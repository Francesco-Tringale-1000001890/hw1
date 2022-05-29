<?php
require_once 'dbconfig.php';
//controlliamo che l'email sia unica
$conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
  
$email=mysqli_real_escape_string($conn, $_GET["q"]);
$query= "SELECT email FROM iscritto WHERE email='$email' ";
$res=mysqli_query($conn, $query);

if(mysqli_num_rows($res)>0){
     $response=array("exists"=> true);
}
else{
     $response=array("exists"=> false);
}
echo json_encode($response); 
mysqli_close($conn);

?>