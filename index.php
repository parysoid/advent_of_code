<?php
    use Tracy\Debugger;

    require 'vendor/autoload.php';

    require_once('days/Base/IDay.php');
    require_once('days/1/DayOne.php');
    require_once('days/2/DayTwo.php');
    require_once('days/3/DayThree.php');

    Debugger::enable();

    $today = new DayThree();

    echo $today->getPartOneResult();
