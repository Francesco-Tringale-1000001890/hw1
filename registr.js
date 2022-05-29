function onResponse(response){
    if(!response.ok) return null;
    return response.json();
}

function CheckNome(event){
    const nome_input=document.querySelector('.nome input');
    console.log(nome_input.value);
    console.log("Lunghezza nome "+ nome_input.value.length);
    console.log(nome_input.value.charAt(0));
    if(nome_input.value.length>0){
        if(nome_input.value.charAt(0) === " "){ //verifico che la stringa non inizi con uno spazio
            document.querySelector('.nome').classList.remove('ValidJS'); //green
            document.querySelector('.nome').classList.add('ErrorJS');
            document.querySelector('.nome span').textContent="Hai immesso uno spazio, non un nome!";    
            Errors.nome='true';  
            CheckForm();
        }else{
        document.querySelector('.nome').classList.remove('ErrorJS');
        document.querySelector('.nome').classList.add('ValidJS'); //green
        document.querySelector('.nome span').textContent="Nome Valido";
        Errors.nome='false';
        CheckForm();  
        }
    }else{
    document.querySelector('.nome').classList.remove('ValidJS'); //green
    document.querySelector('.nome').classList.add('ErrorJS');
    document.querySelector('.nome span').textContent="Ricontrolla il campo nome";
    Errors.nome='true';
    CheckForm();  
    }
    //CheckForm();
}

function CheckCognome(event){
    const cognome_input=document.querySelector('.cognome input');
    console.log(cognome_input.value);
    console.log("Lunghezza nome "+ cognome_input.value.length);
    console.log(cognome_input.value.charAt(0));
    if(cognome_input.value.length>0){
        if(cognome_input.value.charAt(0) === " "){ //verifico che la stringa non inizi con uno spazio
            document.querySelector('.cognome').classList.remove('ValidJS'); //green
            document.querySelector('.cognome').classList.add('ErrorJS');
            document.querySelector('.cognome span').textContent="Hai immesso uno spazio, non un cognome!";
            Errors.cognome='true'; 
            CheckForm();   
        }else{
        document.querySelector('.cognome').classList.remove('ErrorJS');
        document.querySelector('.cognome').classList.add('ValidJS'); //green
        document.querySelector('.cognome span').textContent="Cognome Valido";
        Errors.cognome='false'; 
        CheckForm(); 
        }
    }else{
    document.querySelector('.cognome').classList.remove('ValidJS'); //green
    document.querySelector('.cognome').classList.add('ErrorJS');
    document.querySelector('.cognome span').textContent="Ricontrolla il campo cognome";
    Errors.cognome='true';  
    CheckForm();
    }
    //CheckForm();
}


function onJson_CheckUsername(json){
   console.log(json);
   console.log(json.exists);
   if(json.exists){ //se è true (se esiste)
    document.querySelector('.username').classList.remove('ValidJS');
    document.querySelector('.username').classList.add('ErrorJS');
    document.querySelector('.username span').textContent="ATTENZIONE, Username già in uso";
    Errors.username='true';
   }else{
    document.querySelector('.username').classList.remove('ErrorJS');
    document.querySelector('.username').classList.add('ValidJS'); //green
    document.querySelector('.username span').textContent="Username valido.";
    Errors.username='false';
   }
   CheckForm();
}

function CheckUsername(event){
  const username_input= document.querySelector('.username input');
  console.log(username_input.value);
console.log(username_input.value.length);
  if(username_input.value.length<8){ //controllo la lunghezza dell'username
    document.querySelector('.username').classList.remove('ValidJS');
    document.querySelector('.username').classList.add('ErrorJS'); //aggiungiamo il div username a quella classe
    document.querySelector('.username span').textContent="Inserire almeno 8 caratteri";
    Errors.username='true';
    CheckForm();
 }else{//se supero quel controllo devo controllare che l'username sia unico, la fetch verso quella pagina tornerà un file Json con exist pari a true se l'username esiste già, false altrimenti
     fetch("check_username.php?q="+encodeURIComponent(username_input.value)).then(onResponse).then(onJson_CheckUsername);
 }
}

function onJson_CheckEmail(json){
    console.log(json);
    if(json.exists){ //se è true (se esiste)
        document.querySelector('.email').classList.remove('ValidJS');
        document.querySelector('.email').classList.add('ErrorJS');
        document.querySelector('.email span').textContent="ATTENZIONE, Email già in uso";
        Errors.email='true';
       }else{
        document.querySelector('.email').classList.remove('ErrorJS');
        document.querySelector('.email').classList.add('ValidJS'); //green
        document.querySelector('.email span').textContent="Email valida.";
        Errors.email='false';
       }
       CheckForm();
}
function CheckEmail(event){
    const input_email=document.querySelector('.email input');
    console.log(input_email.value);
    console.log(String(input_email.value).toLowerCase());
    if(!/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input_email.value).toLowerCase())){
        //se non rispetta il pattern dell'email (!true)
        document.querySelector('.email').classList.remove('ValidJS');
        document.querySelector('.email').classList.add('ErrorJS');
        document.querySelector('.email span').textContent="Email non valida";
        Errors.email='true'; //ho un errore in email
        CheckForm();
    }else{ //se supero i controlli
        fetch("check_email.php?q="+encodeURIComponent(String(input_email.value).toLowerCase())).then(onResponse).then(onJson_CheckEmail);
        
    }
 
}
function CheckPassword(event){
    const input_password=document.querySelector('.password input');
    if(!/^(?=.*[!@#$%^&*_])(?=.*[0-9])(?=.*[A-Z]).{10,}$/.test(input_password.value)){ 
         //se non rispetta il pattern della password
         document.querySelector('.password').classList.remove('ValidJS');
         document.querySelector('.password').classList.add('ErrorJS');
         document.querySelector('.password span').textContent="Almeno 10 caratteri, 1 lettera maiuscola, 1 numero, 1 carattere speciale (!@#$%^&*_)";
         Errors.password='true'; //imposto l'errore sulla password a true
         CheckForm();
         
    }else{
        document.querySelector('.password').classList.remove('ErrorJS');
        document.querySelector('.password').classList.add('ValidJS'); //green
        document.querySelector('.password span').textContent="Password valida.";
        Errors.password='false'; //metto false cioé non ho errori
        CheckForm();
        
    }
    
}


 function CheckForm(){
     console.log(Errors); //così ho una visione complessiva di dove ho errore oppure no, ricorda:se Errors è false vuol dire che non ho errori, se Errors è true vuol dire che li ho
     if(Errors.nome==='false' && Errors.cognome==='false' && Errors.username==='false' & Errors.email==='false' & Errors.password==='false'){
        //se sono tutti false allora non ho alcun tipo di errore e quindi posso riabilitare il bottone
        document.getElementById("submit").disabled = false; //abilito il bottone
        document.getElementById("div_registrati").classList.remove('disabled');
        document.getElementById("div_registrati").classList.add('registrati');
        console.log("Bottone abilitato");
     }else{
        //se c'è uno dei seguenti errori
         document.getElementById("submit").disabled = true; //disabilito il bottone
         document.getElementById("div_registrati").classList.remove('registrati');
         document.getElementById("div_registrati").classList.add('disabled');
         console.log("Bottone disabilitato");
     }
 }
 const Errors={}; //creo un array associativo per gestire gli errori del form


document.querySelector('.nome input').addEventListener('blur', CheckNome);
document.querySelector('.cognome input').addEventListener('blur', CheckCognome);
document.querySelector('.username input').addEventListener('blur', CheckUsername);
document.querySelector('.email input').addEventListener('blur', CheckEmail);
document.querySelector('.password input').addEventListener('blur', CheckPassword);
