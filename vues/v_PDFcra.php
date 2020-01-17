
<?php 
$mois=$_POST["mois"];
$annee=$_POST["annee"];
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
$data='';



$data.='<div>';
$data.='<h3 style="float : right;"> Periode : <u> '. getMoisFr($mois).' '.$annee .'</u></h3>';
$data.='</div>';
    
$data.='<div style="float:left;">';
$data.='<h3> Intervenant : <u>' . $consultant->getNom()." ".$consultant->getPrenom() .'</u></h3>';
$data.='</div>';
$data.='<table style="border-collapse: collapse;">';
   

$number=$_POST["number"];

//var_dump($_POST);

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

$data.='</tr>';

$data.='<tr><td></td></tr>';
$data.='<br />';
$data.='<br />';

$data.='<tr><td style="border:2px solid;">Journée facturables</td>';


for($i=1;$i<=$number;$i++){


    $timestamp = mktime(0, 0, 0, $mois, $i, $annee);
    if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
    $data.= '<td style="border:2px solid;background-color:#e1ecfd; text-align:center;">'. $_POST["facturable"][$i-1] .'</td>';
    }
    else{
        $data.= '<td style="border:2px solid;text-align:center;">'. $_POST["facturable"][$i-1] .'</td>';
    }
      
}
$data.='<td style="border:2px solid;font-weight: bold;">Total : '.$TJF.'</td>';



$data.=' </tr>';

    
$data.='<tr><td></td></tr>';
$data.='<br />';
$data.='<br />';

$data.='<tr><td style="border:2px solid;">Absence - congé</td>';


for($i=1;$i<=$number;$i++){

   $timestamp = mktime(0, 0, 0, $mois, $i, $annee); //Donne le timestamp correspondant à cette date

   if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
    $data.= '<td style="border:2px solid;background-color:#e1ecfd;text-align:center;">'. $_POST["conger"][$i-1] .'</td>';
    }
    else{
        $data.= '<td style="border:2px solid;text-align:center;">'. $_POST["conger"][$i-1] .'</td>';
    } 

}
$data.='<td style="border:2px solid;font-weight: bold;">Total : '.$TJC.'</td>';
 $data.='</tr>';



 $data.='<tr><td style="border:2px solid;">Absence - maladie</td>';


for($i=1;$i<=$number;$i++){


   $timestamp = mktime(0, 0, 0, $mois, $i, $annee); 

            
            
   if (date('D', $timestamp)=="Sat" || date('D', $timestamp)=="Sun" ){
    $data.= '<td style="border:2px solid;background-color:#e1ecfd;text-align:center;">'. $_POST["maladie"][$i-1] .'</td>';
    }
    else{
        $data.= '<td style="border:2px solid;text-align:center;">'. $_POST["maladie"][$i-1] .'</td>';
    }
            
        }
        $data.='<td style="border:2px solid;font-weight: bold;">Total : '.$TJM.'</td>';


$data.='</tr>';
$data.='<tr><td></td></tr>';
$data.='<br />';
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
        $data.='<td style="border:2px solid;color:red;font-weight: bold;">Total : '.$cra->getTotal().'</td>';
        $data.='</tr>';

        $data.='</table>';
        $data.='</div>';

   

		$mpdf->WriteHTML($data);
		$mpdf->Output('CRA_'.getMoisFr($mois).'_'.$annee.'.PDF',"D");