<?php
namespace App\View\Helper;
 
use Cake\View\Helper;
use DateTime;

class DateHelper extends Helper {
 
 
     
    public function db($date)
    {   
		$_date = DateTime::createFromFormat('d-m-Y', $date);
        return($_date->format('Y-m-d'));
    }
    public function view($date)
    {   
		$_date = DateTime::createFromFormat('Y-m-d', substr($date,0,10));
        return($_date->format('d-m-Y'));
    }
    public function title($date)
    {   
		$_date = DateTime::createFromFormat('Y-m-d', substr($date,0,10));
        return($_date->format('d-m-Y (l)'));
    }
}
?>