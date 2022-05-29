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
    
    $querySelectElement="SELECT id, nome, price, immagine FROM comics WHERE id='".$id."' ";
    $resSelectElement=mysqli_query($conn, $querySelectElement);
    if(mysqli_num_rows($resSelectElement)>0){ //se è già presente nella tabella comics lo inserisco solo in likes 
        $comicid="SELECT id from comics where id='".$id."'";
        $rescomicid=mysqli_query($conn, $comicid);
        $row = mysqli_fetch_row($rescomicid);
        $controllikes="SELECT * from likes where username_utente='".$username_sessione."' AND id_comic='".$row[0]."'";
        $rescontrollikes=mysqli_query($conn,$controllikes);
        if(mysqli_num_rows($rescontrollikes)>0){
            echo json_encode("Post già con like");
        }else{
            
            $query3="INSERT into likes(username_utente, id_comic) VALUES ('$username_sessione', '$row[0]')";
            $res3=mysqli_query($conn, $query3);
            echo json_encode("Inserimento like con successo!");
        }
      
    }else //se non è presente nella tabella comics
    {
        $query="INSERT into comics(id,nome, price, immagine) VALUES ('$id','$title', '$price', '$image')";
        $res= mysqli_query($conn, $query);
    if($res) {
        
        $comicid="SELECT id from comics where id='".$id."'";
        $rescomicid=mysqli_query($conn, $comicid);
        $row = mysqli_fetch_row($rescomicid);
                if(mysqli_num_rows($rescomicid)>0){
                         $query3="INSERT into likes(username_utente, id_comic) VALUES ('$username_sessione', '$row[0]')";
                         $res3=mysqli_query($conn, $query3);
                         echo json_encode("Inserimento nuovo");
                }
    }else{
      echo json_encode("Errore");
    }
    }
    
    mysqli_close($conn);

   }

?>