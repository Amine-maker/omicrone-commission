JPCalendar
==========

JeffProd-Calendar is a simple PHP class to display a monthly or yearly calendar with events.

It supports actually :
- language : fr, en (default fr)
- start of week : monday, sunday (default monday)
- rendering : monthly, yearly
- events

Samples
=======
```php
require 'class.JPCalendar.php';
$cal=new Calendar();
$cal->setLang('en');
$cal->setDisplay('month','2014-03'); // or for current date use : date('Y').'-'.date('m')
$cal->setEvent('My first event is green','2014-03-01','2014-03-06','#00FF00');
$cal->setEvent('The second is blue','2014-03-10','2014-03-25','#0000FF');
$cal->setEvent('The last is default color','2014-03-26','2014-03-29');
echo $cal->render();
```
will render

![month view](http://fr.jeffprod.com/img/2014-03-22-jpcalendar-mensuel.png)

```php
require 'class.JPCalendar.php';
$cal=new Calendar();
$cal->setLang('en');
$cal->setDisplay('year','2014');
$cal->setEvent('My first event is green','2014-03-01','2014-03-06','#00FF00');
$cal->setEvent('The second is blue','2014-03-10','2014-03-25','#0000FF');
$cal->setEvent('The last is default color','2014-03-26','2014-03-29');
echo $cal->render();
```
will render

![year view](http://fr.jeffprod.com/img/2014-03-22-jpcalendar-annuel.png)

To set start of week, use

```php
$cal->setStartOfWeek('sunday'); // or monday
```

