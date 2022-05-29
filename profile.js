 function remove_like(event){
  const container = event.currentTarget;    //definisce il div cliccato
  const id=container.querySelector("p");
  const title= container.querySelector("h1");   
  const price= container.querySelector("em");
  const img= container.querySelector(".copertina_comics");
  //console.log(title.innerHTML);
  //console.log(price.innerHTML);
  //console.log(img.src);
  //console.log(unlike_button.src);
  let form_data= new FormData();
  form_data.append('id', id.innerHTML);
  form_data.append('title', title.innerHTML);
  form_data.append('price', price.innerHTML);
  form_data.append('image', img.src);
    //controllo l'icona del like
  
  //devo togliere 
  fetch('remove_likes.php',{
    method:'post',
    body: form_data
  }).then(onResponse).then(aggiornaLikes);
}
 
function responseAggiorna(response)
{
    return response.json();
}

function aggiornaLikes()
{
    // Richiedi i nuovi likes e li andiamo a stampare 
    fetch("stampa_likes.php").then(responseAggiorna).then(onJsonStampaLikes);
}
 function onJsonStampaLikes(json){
     console.log(json);
     const vetrina=document.querySelector('#comics_view');
     const vetrina_errore=document.querySelector('#comics_view_error');
     vetrina.innerHTML=''; //pulisco prima di stampare
     vetrina_errore.innerHTML='';
     console.log("Hai messo mi piace a: " + json.length);
  
 
   if(json.length == 0)
   {
     const div_vetrina_errore=document.createElement('div');
     div_vetrina_errore.classList.add('errorstyle');
     const errore = document.createElement("h1"); 
     errore.textContent="Non ti piace nussun fumetto :( ";
     const gif_iron=document.createElement('img');
     gif_iron.src="iron-man_cry.gif";
     div_vetrina_errore.appendChild(errore);
     div_vetrina_errore.appendChild(gif_iron);
     vetrina_errore.appendChild(div_vetrina_errore);
   }
     for(let i=0; i<json.length; i++){
        console.log(json[i].nome);
        console.log(json[i].price);     
        console.log(json[i].immagine);
        console.log(json[i].id);
        const comic_id=json[i].id;
        const comic_title=json[i].nome;
        const comic_price=json[i].price;
        const comic_image=json[i].immagine;
        
        const div_vetrina=document.createElement('div');
        div_vetrina.classList.add('comicsstyle');
        const id=document.createElement("p");
        id.textContent=comic_id;
        const title=document.createElement('h1');
        title.textContent=comic_title;
       const price=document.createElement('em');
       price.textContent=comic_price; 
       const like_button=document.createElement('img');
       like_button.src="like_button.png";
       div_vetrina.appendChild(id);
       div_vetrina.appendChild(title);
        div_vetrina.appendChild(price); 
        const img=document.createElement('img');
       
       img.src=comic_image; 
       
       div_vetrina.appendChild(img);
       img.classList.add('copertina_comics');
       
      
      
      div_vetrina.appendChild(like_button);
      like_button.classList.add('unlikebutton');
     
        //aggiungiamo il div
        vetrina.appendChild(div_vetrina);
        
    }
  
    const Lista= document.querySelectorAll("#comics_view div");
    console.log(Lista);
    //console.log(Lista[1].childNodes[1]);
    
    for (const box of Lista) {        //per aggiungere l'eventlistener a tutti i div stampati
  
      box.addEventListener('click',remove_like);  
      
    }
  }
    
 
 function onResponse(response){
    //console.log(response);
    
    return response.json();
}
//creo la funzione che tramite il DB vede a quali comics ho messo likes
 function search(event){
    event.preventDefault();
 
  fetch("stampa_likes.php").then(onResponse).then(onJsonStampaLikes);    
}

const form=document.querySelector('#stampa_comics');
form.addEventListener('submit', search);