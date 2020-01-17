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
            <!-- <td><?php// echo $UnContrat->getdatedebut(). ' au ' . $UnContrat->getdatefin(); ?></td> -->
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
         </form>

</div>
</div>
<style>
/*** @media all  ***/
* {
  box-sizing: border-box;
}
html {
  height: 100%;
}
body {
  min-height: 100%;
  margin: 0;
  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
  align-items: sretch;
  font: 12pt/1.5 'Raleway', 'Cambria', sans-serif;
  font-weight: 300;
  background: #fff;
  color: #666;
  -webkit-print-color-adjust: exact;
}
header {
  padding: 16px;
  position: relative;
  color: #888;
}
header h1,
header h2 {
  font-weight: 200;
  margin: 0;
}
header h1 {
  font-size: 27pt;
  letter-spacing: 4px;
}
body > * {
  width: 100%;
  max-width: 7in;
  margin: 3px auto;
  /* background: #f0f0f0; */
  text-align: center;
 }

footer {
  padding: 16px;
}
footer p {
  font-size: 9pt;
  margin: 0;
  font-family: 'Nunito';
  color: #777;
}
section,
table {
  padding: 8px 0;
  position: relative;
}
dl {
  margin: 0;
  letter-spacing: -4px;
}
dl dt,
dl dd {
  letter-spacing: normal;
  display: inline-block;
  margin: 0;
  padding: 0px 6px;
  vertical-align: top;
}
dl.bloc > dt,
dl:not(.bloc) dt:not(:last-of-type),
dl:not(.bloc) dd:not(:last-of-type) {
  border-bottom: 1px solid #ddd;
}
dl:not(.bloc) dt {
  border-right: 1px solid #ddd;
}
dt {
  width: 49%;
  text-align: right;
  letter-spacing: 1px !important;
  overflow: hidden;
}
dd {
  width: 49%;
  text-align: left;
}
dd,
tr>td {
  font-family: 'Nunito';
}
section.flex {
  display: flex;
  flex-flow: row wrap;
  padding: 8px 16px;
  justify-content: space-around;
}
dl.bloc {
  padding: 0;
  flex: 1;
  vertical-align: top;
  min-width: 240px;
  margin: 0 8px 8px;
}
dl.bloc>dt {
  text-align: left;
  width: 100%;
  margin-top: 12px;
}
dl.bloc>dd {
  text-align: left;
  width: 100%;
  padding: 8px 0 5px 16px;
  line-height: 1.25;
}
dl.bloc>dd>dl dt {
  width: 33%;
}
dl.bloc>dd>dl dd {
  width: 60%;
}
dl.bloc dl {
  margin-top: 12px;
}
dl.bloc dd {
  font-size: 11pt;
}
table {
  width: 100%;
  padding: 0;
  border-spacing: 0px;
}
table tr {
  margin: 0;
  padding: 0;
  background: #fdfdfd;
  border-right: 1px solid #ddd;
  width: 100%;
}
table tr td,
table tr th {
  border: 1px solid #e3e3e3;
  border-top: 1px solid #fff;
  border-left-color: #fff;
  font-size: 11pt;
  background: #fdfdfd;
}
table thead th {
  background: #e9e9e9;
  background: linear-gradient(to bottom, #f9f9f9, #e9e9e9) !important;
  font-weight: 300;
  letter-spacing: 1px;
  padding: 15px 0 5px;
/*&:not(:last-child)*/
  border: none !important;
}
table tbody tr:last-child td {
  border-bottom: 1px solid #ddd;
}
table tbody td {
  min-width: 75px;
  padding: 3px 6px;
  line-height: 1.25;
}
table tfoot tr td {
/*border 1px solid #e3e3e3
      border-top 1px solid white
      border-left-color #fff*/
  height: 40px;
  padding: 6px 0 0;
  color: #000;
  text-shadow: 0 0 1px rgba(0,0,0,0.25);
  font-family: 'Cambria', 'Raleway', sans-serif;
  font-weight: 400;
  letter-spacing: 1px;
}
table tfoot tr td:first-child {
  font-style: italic;
  color: #997b7b;
}
a {
  color: #992c2c;
}
a:hover {
  color: #b00;
}
@page {
  margin: 0.5cm;
}
/*** @media screen  ***/
html,
body {
  background: #333231;
}
header:before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  border-top: 12px solid #333;
  border-left: 12px solid #ddd;
  width: 0;
  box-shadow: 1px 1px 2px rgba(0,0,0,0.18);
}

</style>