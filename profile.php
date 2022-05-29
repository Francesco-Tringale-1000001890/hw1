<html>
  <head>
    <meta charset="utf-8">
    <title>profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <script src="profile.js" defer></script>     
    <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Inspiration&display=swap" rel="stylesheet">
  </head>

  <body>
      <header>   

           <div id="overlay"> </div> 

           <nav>
                  <div id="collegamenti">
                      <a href="home.php"> HOME  </a>
                      <a href="logout.php"> LOGOUT </a>
                  </div>

                <div id="menu">
                  <div></div>
                  <div></div>
                  <div></div>
               </div>

          </nav>

           
               <h1><strong> BENTORNATO </strong></h1> 
               <?php
                //Avviamo la sessione
                session_start();

                //se non ho fatto il login non ho nessuna variabile di sessione settata, si ritorna login
                if(!isset($_SESSION['username'])){
                    header("Location: Login.php");
                    exit;
                }else {
                    $username_sessione=$_SESSION['username'];
                     echo "<h2>$username_sessione </h2>";
                }

                ?>
                
               <form  name ='search_comics' id='stampa_comics'   >
      
               
                <input type="submit" id="mostra_comics" value="Mostra i miei fumetti preferiti">
                </form>
              

 </header>

<section>
        

        <section id="comics_view">
        </section>
        <section id="comics_view_error">
        </section>

</section>
  </body>

</html>