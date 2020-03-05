<div class ="erreur">
<ul>
<?php 
ajouterErreur('La facture du '.$m.'/'.$a.' n\'existe pas');
foreach($_REQUEST['erreurs'] as $erreur)
	{
      echo "<p style='color : red; text-align:center;'>$erreur</p>";
	}
?>
</ul></div>
