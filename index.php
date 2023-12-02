<?php
    require_once('days/Base/IDay.php');
    require_once('days/1/DayOne.php');
    require_once('days/2/DayTwo.php');

    $today = new DayTwo();

    echo $today->getPartOneResult();
