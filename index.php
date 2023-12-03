<?php
    use Tracy\Debugger;

    require 'vendor/autoload.php';

    require_once('days/Base/IDay.php');
    require_once('days/1/DayOne.php');
    require_once('days/2/DayTwo.php');

    Debugger::enable();

    $today = new DayTwo();

    echo $today->getPartTwoResult();
