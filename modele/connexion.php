
<?php

function bdd(){
$serveur = 'pgsql:host=localhost';
$bdd = 'dbname=i';
$user = 'user=postgres';
$password = 'password=test';
$port="port=5432";



    
$monPdo = new PDO($serveur . ';' .$port.';'. $bdd.';'. $user.';'. $password);
$monPdo->query("SET CHARACTER SET utf8");
}