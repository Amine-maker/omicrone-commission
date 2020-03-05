
<div class="cra">

<div>
    <h3 style="float : right;"> Periode : <u> <?php echo getMoisFr($mois)." ".$annee; ?></u></h3>
</div>
    
<div style="margin-left: 6%;float:left;">
<h3> Intervenant : <u> <?php echo $consultant->getNom()." ".$consultant->getPrenom(); ?></u></h3>
</div>
<form action="index.php?uc=cra&action=createCRA" method="post">
<table style="border-collapse: collapse;">
   



<tr>
    <td></td>
<?php



for($i=1;$i<=$number;$i++){


    $timestamp = mktime(0, 0, 0, $mois, $i, $annee); // Donne le timestamp correspondant à cette date
 
        if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
            echo '<td style="border:2px solid;background-color:#e1ecfd;font-weight: bold;">'.date('D', $timestamp)."  ".$i.'</td>';
        }
        else{
            echo '<td style="border:2px solid;font-weight: bold;">'.date('D', $timestamp)." ".$i.'</td>';
        }
}
?>
</tr>

<tr><td></td></tr>

 <tr>
     <td style="border:2px solid;">Journée facturables</td>
<?php

for($i=1;$i<=$number;$i++){


    $timestamp = mktime(0, 0, 0, $mois, $i, $annee); //Donne le timestamp correspondant à cette date
 
    if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
        echo '<td style="border:2px solid;background-color:#e1ecfd; "><input type="hidden" size="1" value="0" name="facturable[]" step="0.5" max="1" min="0" style="width: 2.75em;height:2.75em; background-color:#e1ecfd;" /></td>';
    }
    else{
        echo '<td style="border:2px solid;"><input type="number" size="1" value="0" name="facturable[]" step="0.5" max="1" min="0" style="width: 2.75em;height:2.75em;" /></td>';
    }
        
}
?>
    </tr>



    
<tr><td></td></tr>

<tr>
    <td style="border:2px solid;">Absence - congé</td>
<?php

for($i=1;$i<=$number;$i++){

   $timestamp = mktime(0, 0, 0, $mois, $i, $annee); //Donne le timestamp correspondant à cette date

        if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
            echo '<td style="border:2px solid;background-color:#e1ecfd;"><input type="hidden" size="1" value="0" name="conger[]" step="0.5" max="1" min="0" style="width: 2.75em;height:2.75em;background-color:#e1ecfd;" /></td>';
        }
        else{
            echo '<td style="border:2px solid;"><input type="number" size="1" value="0" name="conger[]" step="0.5" max="1" min="0" style="width: 2.75em;height:2.75em;" /></td>';
        }

}
?>
   </tr>

    


<tr>
    <td style="border:2px solid;">Absence - maladie</td>
<?php

for($i=1;$i<=$number;$i++){


   $timestamp = mktime(0, 0, 0, $mois, $i, $annee); //Donne le timestamp correspondant à cette date

            if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
                echo '<td style="border:2px solid;background-color:#e1ecfd;"><input type="hidden" size="1" value="0" name="maladie[]" step="0.5" max="1" min="0" style="width: 2.75em;height:2.75em;background-color:#e1ecfd;" /></td>';
            }
            else{
                echo '<td style="border:2px solid;"><input type="number" size="1" value="0" name="maladie[]" step="0.5" max="1" min="0" style="width: 2.75em;height:2.75em;" /></td>';
            }
        }
?>
   </tr>

   <tr><td></td></tr>
   <tr>
    <td style="border:2px solid;">Astreinte</td>
    <td colspan="<?php echo $number; ?>" style="border:2px solid;"><textarea placeholder="Décrire les astreintes" style="width:100%;" rows="4"  name="astreinte"></textarea></td>
   </tr>
   <tr>
    <td style="border:2px solid;">Intervention</td>
    <td colspan="<?php echo $number; ?>" style="border:2px solid;"><textarea placeholder="Décrire les interventions" style="width:100%;" rows="4"  name="interv"></textarea></td>
   </tr>

   
   <?php $consultant=$contrat->getobjcontrat($_POST["idContrat"])->getcleconsultant();
    $idConsultant=$UconsultantDao->getIdConsultantFromobject($consultant);
    $idContrat=$_POST["idContrat"];
   ?>
<input type="hidden" name="number" value="<?php echo $number ?>">
<input type="hidden" name="idContrat" value="<?php echo $idContrat ?>">
<input type="hidden" name="idConsultant" value="<?php echo $idConsultant ?>">
<input type="hidden" name="annee" value="<?php echo $annee ?>">
<input type="hidden" name="mois" value="<?php echo $mois ?>">




</table>



<input type="submit" value="Generer le CRA" class="form-style-5" style="width: 100%;background-color:lightgray;"/>
</form>
    </div>