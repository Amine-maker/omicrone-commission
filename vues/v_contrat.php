<div>  
       <div class="container"> 
       <label><strong>Recherche</strong></label>
       <input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>
       
       <a href="index.php?uc=contrat&action=ajoutC">Ajouter un contrat</a><br><br>
        <?php 
        //include('vues/v_ajContrat.php');
        print(tableauContrat($contrat->getlistecontrat()));?>  
  