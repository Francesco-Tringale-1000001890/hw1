<?php
require_once 'dbconfig.php';
session_start();
if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['price']) && isset($_POST['image']) ){
 $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
 $id=mysqli_real_escape_string($conn, $_POST["id"]);
 $title=mysqli_real_escape_string($conn, $_POST["title"]);
 $price=mysqli_real_escape_string($conn, $_POST["price"]);
 $image=mysqli_real_escape_string($conn, $_POST["image"]);
 $username_sessione=$_SESSION["username"];

 $comicid="SELECT id from comics where id='".$id."' ";
 $rescomicid=mysqli_query($conn, $comicid);
 $row = mysqli_fetch_row($rescomicid);
 $deletelike="DELETE from likes WHERE username_utente='".$username_sessione."' AND id_comic='".$row[0]."'";
 $reslike=mysqli_query($conn, $deletelike);
 echo json_encode("Like rimosso!");
 mysqli_close($conn);
}
?>