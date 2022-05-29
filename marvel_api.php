<?php

/******* ACCEDIAMO ALLE MARVEL_API E CI FACCIAMO RESTITUIRE IL FILE JSON *****/
 $text=$_GET['q'];
 //public key
$publickey="94fe055763a16bf1d668b6b94ed536d4";
//md5 hash
$hash="46aa39cefaf31588626252b54d8389f5";
 $curl=curl_init();

$url_completo="https://gateway.marvel.com/v1/public/comics?format=comic&title=" .$text. "&ts=1&apikey=" .$publickey. "&hash=".$hash;
curl_setopt($curl, CURLOPT_URL, $url_completo);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);

//passo il file json
echo $result;
curl_close($curl); 
  
?>