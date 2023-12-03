<?php
    use Tracy\Debugger;

    require 'vendor/autoload.php';

    $loader = new Nette\Loaders\RobotLoader;

    $loader->addDirectory( __DIR__ . '/app' );

    $loader->setTempDirectory(__DIR__ . '/temp');

    $loader->register();

    Debugger::enable();

    $today = new GearRatios();

    echo $today->getPartTwoResult();
