<?php
    require_once('days/Base/IDay.php');
    require_once('days/1/DayOne.php');

    $today = new DayOne();

    echo $today->getResult();
