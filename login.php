<?php
require_once 'dbconfig.php';
if(isset($_POST["username"]) && isset($_POST["password"]))
{
  session_start();
  //connetto al database
  $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
  //cerco utenti con quelle credenziali
  $username=mysqli_real_escape_string($conn, $_POST["username"]);
  $password=mysqli_real_escape_string($conn, $_POST["password"]);
  
  
  $query="SELECT * FROM iscritto WHERE username='$username' ";
  
  $res=mysqli_query($conn, $query);
  if(mysqli_num_rows($res)>0){
    $row=mysqli_fetch_assoc($res);
  
    if(password_verify($_POST["password"],$row["password"])){
      //impostiamo la variabile di sessione
      $_SESSION["username"]=$username;
      //vai alla pagina home.php
      header("Location: home.php");
      exit;
    }else{
      echo " <p class='errore'>" ;
      echo "Credenziali non valide! ";
      echo "</p>";
    }
}else{
  echo " <p class='errore'>" ;
      echo "Credenziali non valide! ";
      echo "</p>";
}


}

?>

<html>
  
  <head>
    <meta charset="utf-8">
    <title>login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet">
    <script src="login.js" defer></script>
  </head>

  <body>
    <div id="overlay"></div>
      <main>
          <form name='sign_up' method='post'>
              
              <div class="username"> 
                <label> Username <input type='text' name='username'> </label>
                <span></span>
              </div>
              <div class="password"> 
                <label> Password <input type='password' name='password'> </label>
              </div>
              <div id="accedi"> 
                <input type='submit' value='Accedi'>
              </div>
            <p id="crea_account">Non hai ancora un account? <a href=registr.php> Registrati</a></p>
          </form>
      </main>
  </body>

</html>