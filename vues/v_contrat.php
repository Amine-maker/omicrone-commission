<div>  
       <div class="container"> 
      <ul class='responsive-table' id='filter'>
       <label><strong>Recherche</strong></label>
       <input type="text" name="category" class='rechercher' id="categoryFilter"><br><br>
       
         
        <?php 
        include('vues/v_ajContrat.php');
        print(tableauContrat($contrat->getlistecontrat()));?>  
  