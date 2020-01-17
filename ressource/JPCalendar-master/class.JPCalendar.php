<?php
//-----------------------------------------------------------------------
//  AUTHOR	: Jean-Francois GAZET
//  WEB		: http://www.jeffprod.com
//  TWITTER	: @JeffProd
//  MAIL	: jeffgazet@gmail.com
//  LICENCE	: GNU GENERAL PUBLIC LICENSE Version 2, June 1991
//-----------------------------------------------------------------------
// v0.3.3 : minor code optimization
// v0.3.2 : first release, minor rendering improvments
// v0.3.1 : display YEAR : ajout de bordures
// v0.3.0 : display MONTH ajouté + today en jaune
// v0.2.2 : display YEAR : choix de couleur pour les evenements
// v0.2.1 : display YEAR : ajout style CSS + sélecteur d'année
// v0.2.0 : choix du premier jour de semaine (lundi ou dimanche)
// v0.1.0 : display YEAR fonctionnel avec 1er jour de semaine = dimanche
//-----------------------------------------------------------------------

class Calendar
	{
	private $_lng;
	private $_lngDays; // days translation
	private $_lngMonths; // months translation
	private $_lngOther; // other translations
	private $_startOfWeek; // first day of week : monday or sunday
	private $_display; // display mode : month,day,year
	private $_eventLabel; // event to display
	private $_eventColor; // color event
	private $_eventFrom; // date from 'YYYY-MM-DD HH:II'
	private $_eventTo; // date to 'YYYY-MM-DD HH:II'
	private $_dateToday; // date to prevent multiple calls to date()
	
	public function __construct()
		{
		date_default_timezone_set('Europe/Paris');

		// default values
		$this->_lng='fr';
		$this->_startOfWeek='monday';
		$this->_eventLabel=array();
		$this->_eventFrom=array();
		$this->_eventTo=array();
		$this->_eventColor=array();
		$this->_dateToday=array
			(
			'd'=>date('d'),
			'm'=>date('m'),
			'Y'=>date('Y')
			);

		self::setStartOfWeek($this->_startOfWeek); // calls setLang()
		self::setDisplay('year',$this->_dateToday['Y']); 
		}

	public function setStartOfWeek($txt)
		{
		if(!($txt=='monday' || $txt=='sunday')) 
			{
			self::errorMsg('setStartOfWeek','start of week "'.$txt.'" not supported. Must be "monday" or "sunday"');
			return;
			}

		$this->_startOfWeek=$txt;
		self::setLang($this->_lng);
		}

	public function setLang($lng)
		{
		switch($lng)
			{
			case 'fr':
			$this->_lng='fr';
			if($this->_startOfWeek=='sunday') {$this->_lngDays=array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');}
			else {$this->_lngDays=array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');}			
			$this->_lngMonths=array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
			$this->_lngOther=array('Aujourd\'hui','Précédent','Suivant');
			break;
	
			case 'en':
			$this->_lng='en';
			if($this->_startOfWeek=='sunday') {$this->_lngDays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Satursday');}
			else {$this->_lngDays=array('Monday','Tuesday','Wednesday','Thursday','Friday','Satursday','Sunday');}
			$this->_lngMonths=array('January','February','March','April','May','June','July','August','September','October','November','December');
			$this->_lngOther=array('Today','Previous','Next');
			break;

			default:
			self::errorMsg('setLang','language "'.$lng.'" not supported');
			break;
			}		
		}

	// affiche un évènement dans l'agenda, dates au format 'YYYY-MM-DD HH:II'
	public function setEvent($txt,$from,$to,$color='#FF0000')
		{
		$this->_eventLabel[]=$txt;
		$this->_eventColor[]=$color;

		//list($date,$heure)=explode(' ',$from); //'2014-03-01 15:00'
		list($an,$mois,$jour)=explode('-',$from);
		//list($h,$mn)=explode(':',$heure);
		$this->_eventFrom['jour'][]=$jour;
		$this->_eventFrom['mois'][]=$mois;
		$this->_eventFrom['an'][]=$an;
		//$this->_eventFrom['heure'][]=$h;
		//$this->_eventFrom['mn'][]=$mn;

		//list($date,$heure)=explode(' ',$to); //'2014-03-01 15:00'
		list($an,$mois,$jour)=explode('-',$to);
		//list($h,$mn)=explode(':',$heure);
		$this->_eventTo['jour'][]=$jour;
		$this->_eventTo['mois'][]=$mois;
		$this->_eventTo['an'][]=$an;
		//$this->_eventTo['heure'][]=$h;
		//$this->_eventTo['mn'][]=$mn;
		}

	// choix de l'affichage : year|month|day and its value (i.e. 2014 for year 02 for month or day)
	public function setDisplay($choice,$value)
		{
		// valeurs testées dans render()
		if(isset($_GET['calDate'])) {$value=$_GET['calDate'];}
		$this->_display=array($choice,$value);
		}

	public function render()
		{
		$y=''; $m=''; $d='';
		if(preg_match('~\d{4}\-\d{2}\-\d{2}~',$this->_display[1]))
			{
			list($y,$m,$d)=explode('-',$this->_display[1]);
			}
		elseif(preg_match('~\d{4}\-\d{2}~',$this->_display[1]))
			{
			list($y,$m)=explode('-',$this->_display[1]);
			}
		else
			{
			$y=$this->_display[1];
			}
		switch($this->_display[0])
			{
			case 'day':
			return self::renderDay($y,$m,$d);
			break;
			
			case 'month':
			if(self::isYear($y) && self::isMonth($m)) {return self::renderMonth($y,$m);}
			self::errorMsg('render','date must be YYYY-MM (year-month, i.e. : 2014-04)');
			break;
			
			case 'year':
			if(self::isYear($y)) {return self::renderYear($y);}
			self::errorMsg('render','"'.$this->_display[1].'" is not a year (YYYY)');
			break;

			default: 
			self::errorMsg('render','display "'.$this->_display[0].'" not supported. Must be : day,month,year');
			break;
			}
		}

	// check if arg is a year like 'YYYY' (i.e. 2014)
	private static function isYear($y)
		{
		if(!preg_match('/(\d){4}/',$y)) {return false;}
		if($y>9999) {return false;}
		if($y<1) {return false;}
		return true;
		}

	// check if arg is date like 'YYYY-MM' (i.e. 2014-03)
	private static function isMonth($m)
		{
		if(!preg_match('/^(\d){2}$/',$m)) {return false;}
		if($m>12) {return false;}
		if($m<1) {return false;}
		return true;
		}

	private function errorMsg($function,$txt)
		{
		echo 'Calendar - '.$function.'() : '.$txt.'.';
		}

	private function renderDay()
		{
		;
		}

	private function renderMonth($y,$m)
		{
		$r='';

		// getting first day of each month
		$firstDayofMonth=self::getFirstDayofMonth($m,$y);

		// getting number of days in each month : 28 to 31 
		$lastDayofMonth=self::getLastDayofMonth($m,$y);

		$r.=self::styleCSS();

		$r.='<table border="1">'.PHP_EOL;
		$r.='<tbody>'.PHP_EOL;

		$r.='<tr class="calHead">';
		$r.='<td>'.self::monthYearSelect($m,$y).'</td>'.PHP_EOL;
		// table header = 7 days
		for($i=0;$i<7;$i++) {$r.='<td>'.substr($this->_lngDays[$i],0,2).'</td>'.PHP_EOL;}
		$r.='</tr>'.PHP_EOL;

		$cpt=1;
		$numweek=self::getNumberOfWeek($y,$m,1); // first week number

		// 6 rows
		for($j=0;$j<6;$j++) 
			{
			$r.='<tr>';
			$r.='<td class="calHead">'.$numweek.'</td>'.PHP_EOL; $numweek++;
			for($i=0;$i<7;$i++) 
				{
				if(($firstDayofMonth==$i || $cpt>1) && $cpt<=$lastDayofMonth) 
					{
					$r.='<td'.self::setCellColor($cpt,$m,$y).'>';
					$r.=$cpt;
					$cpt++;
					$r.='</td>'.PHP_EOL;					
					}
				else {$r.='<td></td>'.PHP_EOL;}
				}
			$r.='</tr>'.PHP_EOL;
			}

		$r.='</tbody>'.PHP_EOL;
		$r.='</table>'.PHP_EOL;

		return $r;
		}

	private function renderYear($year)
		{
		// 	Su Mo ...
		// jan  1..31 ...
		// fev  1..31 ...
		// ...
		$r=self::styleCSS();

		$r.='<table>'.PHP_EOL;
		$r.='<tbody>'.PHP_EOL;
		$r.='<tr class="calHead">'.PHP_EOL;
		$r.='<td>'.self::yearSelect($year).'</td>'.PHP_EOL;

		// table header = days
		// 6 weeks in a row
		for($nbweeks=0;$nbweeks<6;$nbweeks++)
			{
			// 7 days a week
			for($i=0;$i<7;$i++) {$r.='<td';  if($i==0) {$r.=' class="calBordL"';} $r.='>'.substr($this->_lngDays[$i],0,2).'</td>'.PHP_EOL;}
			}

		$r.='</tr>'.PHP_EOL;

		// 12 rows for each month
		for($nbmois=0;$nbmois<12;$nbmois++)
			{
			$cpt=1;	

			// getting first day of month
			$firstDayofMonth[$nbmois]=self::getFirstDayofMonth($nbmois+1,$year);

			// getting number of days in month : 28 to 31 
			$lastDayofMonth[$nbmois]=self::getLastDayofMonth($nbmois+1,$year);
			
			$r.='<tr>'.PHP_EOL;
			$r.='<td class="calHead">'.$this->_lngMonths[$nbmois].'</td>'.PHP_EOL;

			// 6 weeks in a row
			for($nbweeks=0;$nbweeks<6;$nbweeks++)
				{
				// 7 days a week
				for($nbj=0;$nbj<7;$nbj++) 
					{
					if(($firstDayofMonth[$nbmois]==$nbj || $cpt>1) && $cpt<=$lastDayofMonth[$nbmois]) 
						{
						$r.='<td'.self::setCellColor($cpt,$nbmois+1,$year);  if($nbj==0) {$r.=' class="calBordL"';} $r.='>';
						$r.=$cpt;
						$cpt++;
						$r.='</td>'.PHP_EOL;					
						}
					else {$r.='<td'; if($nbj==0) {$r.=' class="calBordL"';} $r.='></td>'.PHP_EOL;}					
					}
				}
			$r.='</tr>'.PHP_EOL;
			}

		$r.='</tbody>'.PHP_EOL;
		$r.='</table>'.PHP_EOL;

		return $r;
		}
	
	// Navigation buttons for year display
	private function yearSelect($year)
		{
		$r='';

		// Previous year button
		if($year-1>0) {$r.='<input type="button" onClick="document.location.href=\'?calDate='.($year-1).'\'" value="&lt;&lt;">'.PHP_EOL;}

		// Current year
		$r.=$year;

		// Next year button
		if($year+1<10000) {$r.=' <input type="button" onClick="document.location.href=\'?calDate='.($year+1).'\'" value="&gt;&gt;">'.PHP_EOL;}

		// Today button
		$r.='<br><input type="button" onClick="document.location.href=\'?calDate='.$this->_dateToday['Y'].'\'" value="'.$this->_lngOther[0].'">'.PHP_EOL;

		return $r;
		}

	// Navigation buttons for month display
	private function monthYearSelect($m,$y)
		{
		$r='';

		// Previous month button (YYYY-MM)
		$previous=$y.'-'.(($m-1<10)?'0'.($m-1):($m-1));
		if($m-1<1) {$previous=($y-1).'-12';}
		if($y-1>0) {$r.='<input type="button" onClick="document.location.href=\'?calDate='.$previous.'\'" value="&lt;&lt;">'.PHP_EOL;}

		// Current month
		$r.=$this->_lngMonths[$m-1].' '.$y;

		// Next month button (YYYY-MM)
		$next=$y.'-'.(($m+1<10)?'0'.($m+1):($m+1));
		if($m+1>12) {$next=($y+1).'-01';}
		if($y+1<10000) {$r.=' <input type="button" onClick="document.location.href=\'?calDate='.$next.'\'" value="&gt;&gt;">'.PHP_EOL;}

		// Today button
		$r.='<br><input type="button" onClick="document.location.href=\'?calDate='.$this->_dateToday['Y'].'-'.$this->_dateToday['m'].'\'" value="'.$this->_lngOther[0].'">'.PHP_EOL;

		return $r;
		}

	// CSS style
	private static function styleCSS()
		{
		$r='';
		$r.='<style type="text/css">'.PHP_EOL;

		$r.='table {'.PHP_EOL;
		$r.=' -webkit-print-color-adjust: exact;'.PHP_EOL; // pour imprimer les couleurs de cellules
		$r.=' border-spacing: 0px;'.PHP_EOL; 
		$r.=' border-padding: 0px;'.PHP_EOL; 
		$r.=' border: 1px solid black;'.PHP_EOL;
		$r.=' border-top: 0px;'.PHP_EOL; 
		$r.=' border-left: 0px;'.PHP_EOL; 
		$r.=' }'.PHP_EOL;

		$r.='td {'.PHP_EOL; 
		$r.=' text-align: center;'.PHP_EOL;
		$r.=' width: 20px;'.PHP_EOL;
		$r.=' border-top: 1px solid black;'.PHP_EOL; 
		$r.=' border-left: 1px solid black;'.PHP_EOL; 
		$r.='}'.PHP_EOL; 

		$r.='.calHead {'.PHP_EOL;  
		$r.=' font-weight: bold;'.PHP_EOL; 
		$r.=' background: #ccc;'.PHP_EOL;
		$r.=' white-space: nowrap;'.PHP_EOL;
		$r.=' }'.PHP_EOL;

		$r.='.calBordL {'.PHP_EOL;  
		$r.=' border-left: 3px solid black;'.PHP_EOL; 
		$r.=' }'.PHP_EOL;

		$r.='</style>'.PHP_EOL;
		return $r;
		}

	// return first day of month 
	// $month : 1 to 12
	// $year : int
	// return : 0..6 (sunday to satursday) or 1..7 (monday to sunday)
	private function getFirstDayofMonth($month,$year)
		{
		if($this->_startOfWeek=='sunday')
			{
			return date('w',mktime (0, 0, 0, $month, 1, $year)); // 0(di) to 6(sa)
			}
		else
			{
			return date('N',mktime (0, 0, 0, $month, 1, $year))-1; // 1(lu) to 7(di)
			}
		}

	// return last day of month 
	// $month : 1 to 12
	// $year : int
	// return : 28,29,30 or 31
	private static function getLastDayofMonth($month,$year)
		{
		return date('t',mktime (0, 0, 0, $month, 15, $year));
		}

	// Returns the ISO number of week
	private static function getNumberOfWeek($y,$m,$d)
		{
		return intval(date('W',mktime(0,0,0,$m,$d,$y)));
		}

	// Returns cell color an title for events and today
	private function setCellColor($d,$m,$y)
		{
		$r='';
		$color='';
		$title='';

		// today cell in yellow
		if($d==$this->_dateToday['d'] && $m==$this->_dateToday['m'] && $y==$this->_dateToday['Y']) {$color='#FFFF00';}

		$mktime=mktime(0,0,0,$m,$d,$y);
		while (list($key, $value) = each($this->_eventLabel))
			{
			if(
			$mktime>=mktime(0, 0, 0, $this->_eventFrom['mois'][$key], $this->_eventFrom['jour'][$key], $this->_eventFrom['an'][$key]) && // mktime:h,m,s,mois,jour,an 
			$mktime<=mktime(0, 0, 0, $this->_eventTo['mois'][$key], $this->_eventTo['jour'][$key], $this->_eventTo['an'][$key])
			)
				{
				// there is an event on this day so we set color and title
				if($color=='') {$color=$this->_eventColor[$key];}
				$title=$value;
				break;
				}
			}
		reset($this->_eventLabel);

		if($color!='') {$r.=' style="background-color: '.$color.';"';}
		if($title!='') {$r.=' title="'.$title.'"';}

		return $r;	
		}

	} // Class
?>
