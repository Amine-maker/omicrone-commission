<div class='container'>
    <div class='form-style-5'>
         <form method='POST' action='index.php?uc=facture&action=creerfacture&idcontrat=<?php echo $idContrat?>'>
         <header>
    <h1>FACTURE <h2>Omicrone</h2></h1>
  </header>
    <section class="flex">
        <dl>
            <dt>Facture # :</dt><dd><?php echo $idfacture ?></dd>
            <dt>Date de facturation : </dt><dd> <?php echo date('d/m/Y');?></dd>
        </dl>
    </section>
  <section class="flex">
    <dl class="bloc">
      <dt>Facturé au client :</dt>
      <dd>
        <?php echo $UnContrat->getcleclient()->getraisonsocial(); ?><br>
        <?php echo $UnContrat->getcleclient()->getadr(); ?><br>
        <?php echo $UnContrat->getcleclient()->getville().' - '. $UnContrat->getcleclient()->getcp()?>
            <dl>
                <dt>SIRET</dt>
                <dd><?php echo $UnContrat->getcleclient()->getsiret(); ?></dd>
                <dt>Téléphone</dt>
                <dd><?php echo $UnContrat->getcleclient()->getclecontact()->gettel(); ?></dd>
                <dt>Email </dt>
                <dd><?php echo $UnContrat->getcleclient()->getclecontact()->getemail(); ?></dd>
            </dl>
      </dd>
    </dl>
    <dl class="bloc">
      <dt>Le consultant:</dt>
      <dd><?php echo $UnContrat->getcleconsultant()->getNom().' '.$UnContrat->getcleconsultant()->getPrenom()?><br>
      <?php echo $UnContrat->getcleconsultant()->getAdresse();?><br>
      <?php echo $UnContrat->getcleconsultant()->getVille(). ' - '.$UnContrat->getcleconsultant()->getCp()?><br><br>
      Email : <?php echo $UnContrat->getcleconsultant()->getEmail(); ?>
      </dd>
      <dt>Période totale:</dt>
      <dd>Du <?php echo $UnContrat->getdatedebut(). ' au ' . $UnContrat->getdatefin(); ?></dd>
    </dl>
  </section>
    <table>
        <thead>
        <tr> 
            <!-- <th>Période</th> -->
            <th>Mission</th>
            <th>TJM</th>
            <?php if ($UnContrat->getsalaire() == 0) {
                echo "<th>Tarif</th>";
            } 
            else {
                echo "<th>Salaire</th>";
           }?>
            
            <th>Montant</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <!-- <td><?php // echo $UnContrat->getdatedebut(). ' au ' . $UnContrat->getdatefin(); ?></td> -->
            <td>Dévelopement .... </td>
            <td></td>
            <td><?php if($UnContrat->getsalaire() == 0){
             echo $UnContrat->gettarif();
                }   
            else {
                echo  $UnContrat->getsalaire();
            } ?></td>
            <td><?php $Unefacture->getmontant(); ?>€</td>
        </tr>
        </tbody>
        <tfoot>
          <tr>
          <td colspan="2"></td>
          <td>TVA :</td>
          <td><?php  ?>%</td>
          </tr>
        <tr> 
            <td colspan="2">− Faire les chèques payable au nom de moi −</td>
            <td>Total:</td>
            <td><?php $Unefacture->getmontant(); ?>€</td>
        </tr>
        </tfoot>
    </table>
  <footer>
    <p>Moyen de paiement : chèque, virement bancaire</p>
    <p>Délai de réglement à 30 jours</p>
  </footer>
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
                <?php } 
                else { ?>
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