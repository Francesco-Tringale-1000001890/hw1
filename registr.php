
  <?php 
  require_once 'dbconfig.php';
  session_start();
   $count=0;
  if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]))
  {
 
   $conn=mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Errore: ". mysqli_connect_error());
   
   //gestisco l'username 
    $username=mysqli_real_escape_string($conn, $_POST["username"]);
    $query="SELECT username FROM iscritto WHERE username='$username'";
    $res=mysqli_query($conn, $query);
    if(mysqli_num_rows($res)>0){
        $count++;
        echo "<p class='errore'>";
        echo "Questo username è già in uso";
        echo "</p>"; 
    }
    
    if(strlen($username)<8){
       $count++;
      echo "<p class='errore'>";
        echo "L'username deve essere di almeno 8 caratteri";
        echo "</p>";
    }

   
   //password
   $password=mysqli_real_escape_string($conn,$_POST["password"]);
  $pattern='/^(?=.*[!@#$%^&*_])(?=.*[0-9])(?=.*[A-Z]).{10,}$/';
  /* minimo 10 caratteri, massimo qualunque 
   minimo 1 lettera maiuscola
   minimo 1 numero
   minimo 1 dei suguenti caratteri speciali
  */
   if(!preg_match($pattern, $password)){
     $count++;
    echo "<p class='errore'>";
    echo "Inserire almeno 10 caratteri, 1 lettera maiuscola, 1 numero, e almeno uno dei seguenti caratteri speciali !@#$%^&*_ ";
    echo "</p>";
   }

   $email=mysqli_real_escape_string($conn,$_POST['email']);
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $count++;
    echo "<p class='errore'>";
    echo "Email non valida!";
    echo "</p>";
   }
   
   //se supero tutti i controlli allora faccio questo
  if($count==0){
     $nome=mysqli_real_escape_string($conn,$_POST['nome']);
     $cognome=mysqli_real_escape_string($conn,$_POST['cognome']);
    $password=password_hash($password,PASSWORD_BCRYPT); //per mettere la password cryptata
  
      $query="INSERT into iscritto 
      VALUES('$nome', '$cognome', '$username', '$email', '$password')";
      if(mysqli_query($conn, $query)){
        $_SESSION["username"]= $username;
        header("Location: home.php");
        mysqli_close($conn);
        exit;
      } 
    }
  }
  
?> 

<html>
  
  <head>
    <meta charset="utf-8">
    <title>registrazione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registr.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet">
   <script src="registr.js" defer></script> 
  </head>
  
  <body>
    <div id="overlay"></div>
      <main>
          <form name='sign_up' method='post'>
              <div class="nome">
                <label> Nome <input type='text' name='nome'> </label>
                <span></span>
              </div>
              <div class="cognome"> 
                <label> Cognome <input type='text' name='cognome'> </label>
                <span></span>
              </div>
              <div class="username"> 
                <label> Username <input type='text' name='username'> </label>
                <span></span>
              </div>
              <div class="email"> 
                <label> Email <input type='text' name='email'> </label>
                <span></span>
              </div>
              <div class="password"> 
                <label> Password <input type='password' name='password'> </label>
                <span></span>
              </div>
              <div class="registrati" id="div_registrati"> 
                <input type='submit' id='submit' name='Registrati' value='Registrati' > 
              </div>
              <p id="log">Hai già un account? <a href=login.php> Accedi</a></p>
          </form>
      </main>
  </body>

</html>