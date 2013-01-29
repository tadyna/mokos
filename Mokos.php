<?php
require 'vendor/autoload.php';
use Symfony\Component\Console\Application;
use Mokos\Console\GenerateAllCommand;

$console = new Application();
$console->add(new GenerateAllCommand());
$console->run();