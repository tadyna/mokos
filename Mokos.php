<?php
namespace Mokos;

require 'vendor/autoload.php';
use Symfony\Component\Console\Application;
use Mokos\Database\AdapterMysql;

new AdapterMysql();

$console = new Application();
$console->run();