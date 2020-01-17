<?php
require 'class.JPCalendar.php';
$cal=new Calendar();
$cal->setLang('en');
//$cal->setStartOfWeek('sunday');
//$cal->setDisplay('year',date('Y')); // [year|month|day],[YYYY]
$cal->setDisplay('month',date('Y').'-'.date('m')); // [year|month|day],[YYYY-MM]
$cal->setEvent('My first event is green','2014-03-01','2014-03-06','#00FF00');
$cal->setEvent('The second is blue','2014-03-10','2014-03-25','#0000FF');
$cal->setEvent('The last is default color','2014-03-26','2014-03-29');
echo $cal->render();
?>
