<?php
namespace CodeHeroPHPUnit\Test;

date_default_timezone_set('America/Argentina/Buenos_Aires');//Problemas en mi mac, no me sente a ver poque require eso

class ProvidersTest extends \PHPUnit_Framework_TestCase
{


    public function testBusinessDays(){
        $day = date('D', strtotime('2016-01-01 10:25:55') );//true
        //$day = date('D', strtotime('2016-01-03 10:25:55') );//Domingo
        $valid = ($day!=='Sat' && $day!=='Sun' ) ? true : false;

        $this->assertTrue($valid);
    }

    public function testBusinessHours(){
        $hour = date('H', strtotime('2016-01-01 10:25:55') );//true
        //$hour = date('H', strtotime('2016-01-01 07:25:55') );//false
        $valid = ($hour >= 8 && $hour <= 20) ? true : false;

        $this->assertTrue($valid);
        $this->assertEquals(10, $hour);
    }
}
?>
