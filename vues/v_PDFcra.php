
<?php 
$mois=$_POST["mois"];
$annee=$_POST["annee"];
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$mpdf->showImageErrors = true;
$data='';

$data.='<div>';
$data.=' <img src="logo/omicrone.jpg" width="250" style="float:right;" />'; // 90 pixels, just like HTML
$data.='</div>';


$data.='<div style="float:left;">';
$data.='<h3 style="margin-top:-100px;"> Periode : <u> '. getMoisFr($mois).' '.$annee .'</u></h3>';
$data.='<h3 style=""> Intervenant : <u>' . $consultant->getNom()." ".$consultant->getPrenom() .'</u></h3>';
$data.='<h3 style=""> Client : <u>' . $nomClient .'</u></h3>';
$data.='</div>';
$data.='<table style="border-collapse: collapse;">';
   

$number=$_POST["number"];

//var_dump($_POST);

$data.='<tr><td></td><br>';


for($i=1;$i<=$number;$i++){


    $timestamp = mktime(0, 0, 0, $mois, $i, $annee); // Donne le timestamp correspondant à cette date
 
        if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
            $data.= '<td style="border:2px solid;background-color:#e1ecfd;font-weight: bold;">'.date('D', $timestamp)." ".$i.'</td>';
        }
        else{
            $data.= '<td style="border:2px solid;font-weight: bold;">'.date('D', $timestamp)."  ".$i.'</td>';
        }
}

$data.='</tr>';

$data.='<tr><td></td></tr>';
$data.='<br />';
$data.='<br />';

$data.='<tr><td style="border:2px solid;">Journée facturables</td>';


for($i=1;$i<=$number;$i++){
    if($_POST["facturable"][$i-1]==0){
        $_POST["facturable"][$i-1]='';
    }

    $timestamp = mktime(0, 0, 0, $mois, $i, $annee);
    if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
    $data.= '<td style="border:2px solid;background-color:#e1ecfd; text-align:center;">'. $_POST["facturable"][$i-1] .'</td>';
    }
    else{
        $data.= '<td style="border:2px solid;text-align:center;">'. $_POST["facturable"][$i-1] .'</td>';
    }
      
}
$data.='<td style="border:2px solid;font-weight: bold;">Total '.$TJF.'</td>';

$data.=' </tr>';
    
$data.='<tr><td></td></tr>';
$data.='<br />';

$data.='<tr><td style="border:2px solid;">Absence - congé</td>';


for($i=1;$i<=$number;$i++){

    if($_POST["conger"][$i-1]==0){
        $_POST["conger"][$i-1]='';
    }
   $timestamp = mktime(0, 0, 0, $mois, $i, $annee); //Donne le timestamp correspondant à cette date

   if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
    $data.= '<td style="border:2px solid;background-color:#e1ecfd;text-align:center;">'. $_POST["conger"][$i-1] .'</td>';
    }
    else{
        $data.= '<td style="border:2px solid;text-align:center;">'. $_POST["conger"][$i-1] .'</td>';
    } 

}
$data.='<td style="border:2px solid;font-weight: bold;">Total '.$TJC.'</td>';
 $data.='</tr>';



 $data.='<tr><td style="border:2px solid;">Absence - maladie</td>';


for($i=1;$i<=$number;$i++){


   $timestamp = mktime(0, 0, 0, $mois, $i, $annee); 

   if($_POST["maladie"][$i-1]==0){
    $_POST["maladie"][$i-1]='';
}
            
   if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
    $data.= '<td style="border:2px solid;background-color:#e1ecfd;text-align:center;">'. $_POST["maladie"][$i-1] .'</td>';
    }
    else{
        $data.= '<td style="border:2px solid;text-align:center;">'. $_POST["maladie"][$i-1] .'</td>';
    }
            
        }
        $data.='<td style="border:2px solid;font-weight: bold;">Total '.$TJM.'</td>';


$data.='</tr>';

$data.='<tr><td></td></tr>';
$data.='<br />';





$data.=' <tr>';
$data.='  <td style="border:2px solid;">Astreinte</td>';
$data.='   <td colspan='. $number.' style="border:2px solid;"><textarea style="width:100%;height:6%;">'.$_POST["astreinte"] .'</textarea></td>
        </tr>';
$data .='<tr><td style="border:2px solid;">Interventions</td><td colspan='. $number.' style="border:2px solid;"><textarea style="width:100%;height:6%;">'.$_POST["interv"] .'</textarea></td>
</tr>';

        $data.='<tr><td></td></tr>';
        $data.='<br />';
        
        

        $data.='<tr><td></td><br>';
    
        for($i=1;$i<=$number;$i++){


            $timestamp = mktime(0, 0, 0, $mois, $i, $annee); // Donne le timestamp correspondant à cette date
         
                if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
                    $data.= '<td style="border:2px solid;background-color:#e1ecfd;font-weight: bold;">'.date('D', $timestamp).'</td>';
                }
                else{
                    $data.= '<td style="border:2px solid;font-weight: bold;">'.date('D', $timestamp).'</td>';
                }
        }
        $data.='<td style="border:2px solid;color:red;font-weight: bold;">Total '.$cra->getTotal().'</td>';
        $data.='</tr>';

       
        $data.='</table>';
        $data.='</div>';

   

        $data.='  <div style="background-color: white;
                width: 700px;
                margin-left:10%;
                border: 2px solid black;
                padding: 20px;
                ">
                 <h3 style="color:red;margin-left:20%;float:left;margin-top:-10px;">Client&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Prestataire</h3>
                    <br>
                <div style="border-bottom:2px solid black;
                height:-20px;">';
  
  

  $data.=' </div>';
  $data.='<br>';
  $data.='<h4> Date : </h4>';
  $data.='<h4> Signature : </h4>';

  $data.='</div>';

		$mpdf->WriteHTML($data);
		$mpdf->Output('CRA/CRA_'.getMoisFr($mois).'_'.$annee.'.pdf',"F");