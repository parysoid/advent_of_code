<?php
    use Tracy\Debugger;

    require 'vendor/autoload.php';

    require_once('base/ITask.php');
    require_once('2023/1/Trebuchet.php');
    require_once('2023/2/CubeConundrum.php');
    require_once('2023/3/GearRatios.php');

    Debugger::enable();

    $today = new GearRatios();

    echo $today->getPartTwoResult();
