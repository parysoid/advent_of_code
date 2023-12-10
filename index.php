<?php

    use Tracy\Debugger;

    require 'vendor/autoload.php';

    set_time_limit( 60 * 60 * 24 );

    const INPUTS_PATH = __DIR__. '/inputs';

    $loader = new Nette\Loaders\RobotLoader;

    $loader->addDirectory( __DIR__ . '/app' );

    $loader->setTempDirectory( __DIR__ . '/temp' );

    $loader->register();

    Debugger::enable();
    Debugger::$maxLength = 15000;

    $today = new MirageMaintenance();

    echo $today->getPartTwoResult();