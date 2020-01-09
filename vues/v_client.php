<div class="container"> 
<h1>Client</h1>

<a href="index.php?uc=client&action=ajclient">Ajouter</a><br><br>
<?php print tableauClient($clientDao->listeclient());?>