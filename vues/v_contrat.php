   <div class="container"> 
   <label><strong>Recherche</strong></label>
   <input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>

   <a href="index.php?uc=contrat&action=ajoutC">Ajouter un contrat</a><br><br>
    <?php print(tableauContrat($lesContrats));?>  
   
   </div>
