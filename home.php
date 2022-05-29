
<?php 
   //avvio la sessione
   session_start();
   //verifichiamo se l'utente ha fatto il login
   if(!isset($_SESSION['username'])){
     //andiamo al login
     header("Location: login.php");
     exit;
   }     
?> 

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <script src="home.js" defer></script>    
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@200;400&display=swap" rel="stylesheet">
  </head>

  <body>
      <header>   

           <div id="overlay"> </div> 

           <nav>
                  <div id="collegamenti">
                      <a href="profile.php"> PROFILO </a>
                      <a href="logout.php"> LOGOUT </a>
                  </div>

                <div id="menu">
                  <div></div>
                  <div></div>
                  <div></div>
               </div>

          </nav>

           <h1> 
                Cerca il tuo fumetto  
            </h1>
               <form  name ='search_comics' id='search_comics'   >
      
                
            
                <input type='text' name ='content' id='content' placeholder="Digita il nome di un supereroe (Example: Hulk, X-man, Spider-man, Iron-man...)" >
                <input type="submit" id="submit" value="Conferma scelta">
        </form>
          

 </header>

<section>
        
        <div class="loading"></div>
        <section id="comics_view">
        </section>
        <section id="comics_view_error">
        </section>

</section>


<footer> 
   
  
   
  <address> Francesco-Tringale-1000001890 </address>
    <p> Catania</p>
  
</footer>

  </body>

</html>