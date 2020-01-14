<div class='container'>
    <div class='form-style-5'>
         <form method='POST' action='index.php?uc=facture&action=genererfacture'>
            <fieldset>
                <legend>Facture du client</legend>
                <?php 
                       print_r($UnContrat);
                    ?>
                <p>L'entreprise : <?php echo  $raisonsocial = $UnContrat->getcleclient()->getraisonsocial(); ?></p>
                <input type='hidden' name='rsl' required='required' value='<?php echo $raisonsocial?>' placeholder='Le Client'>
                <?php if ($UnContrat->getsalaire() == 0 ){
                    ?><p>Le montant dû est :<?php $tarif = $UnContrat->gettarif();?></p>
                      <input type='hidden' name='tarif' required='required' value='<?php echo $tarif?>' placeholder='Le montant dû '>
                <?php} 
                else {?>
                     <p>Le montant dû est : <?php $salaire = $UnContrat->getsalaire();?></p>
                    <input type='hidden' name='salaire' required='required' value='<?php echo $salaire?>' placeholder='Le montant dû '>
                <?php }?>
                
                
                <p>Date de création de la facture : <?php echo date('d/m/Y');?></p>
                <input type='hidden' name='datej' required='required' value='<?php date('Y,m,d');?>' placeholder='<?php echo date('d/m/Y');?>'>
                <input type='submit' name='creerfacture' value='Créer la facture'>
            </fieldset>
         </form>
    
</div>
</div>