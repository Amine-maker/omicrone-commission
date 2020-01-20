<div class="container"> 
<h1>Client</h1>
<label><strong>Recherche</strong></label>
<input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>
<a href="index.php?uc=client&action=ajclient">Ajouter</a><br><br>
<?php print tableauClient($lesclients);?>