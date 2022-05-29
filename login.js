function onResponse(response){
    if(!response.ok) return null;
    return response.json();
}

function onJson_CheckUsername(json){
    console.log(json);
    console.log(json.exists);
    if(!json.exists){ //se non esiste (è false)
     document.querySelector('.username').classList.remove('ValidJS');
     document.querySelector('.username').classList.add('ErrorJS');
     document.querySelector('.username span').textContent="Sei sicuro di essere già iscritto?";
     
    }else{ //altrimenti
     document.querySelector('.username').classList.remove('ErrorJS');
     document.querySelector('.username').classList.add('ValidJS'); //green
     document.querySelector('.username span').textContent="Username valido.";
     
    }
 }
function CheckUsername(event){
    const username_input= document.querySelector('.username input');
    console.log(username_input.value);
  console.log(username_input.value.length);
    if(username_input.value.length<8){ //controllo la lunghezza dell'username
      document.querySelector('.username').classList.remove('ValidJS');
      document.querySelector('.username').classList.add('ErrorJS'); //aggiungiamo il div username a quella classe
      document.querySelector('.username span').textContent="Inserire almeno 8 caratteri";
       
   }else{//se supero quel controllo devo controllare che l'username sia unico, la fetch verso quella pagina tornerà un file Json con exist pari a true se l'username esiste già, false altrimenti
       fetch("check_username.php?q="+encodeURIComponent(username_input.value)).then(onResponse).then(onJson_CheckUsername);
   }
  }

document.querySelector('.username input').addEventListener('blur', CheckUsername);