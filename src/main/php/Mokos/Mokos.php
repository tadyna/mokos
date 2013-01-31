<?php
namespace Mokos;
require_once '/../../../../vendor/autoload.php';
use Symfony\Component\Console\Application;
use Mokos\Console\Command\GreetCommand;

$console = new Application();
$console->add(new GreetCommand());
$console->add(new Console\Command\GenerateCommand());
$console->run();