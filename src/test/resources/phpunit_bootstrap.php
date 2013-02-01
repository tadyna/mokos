<?php
require_once '../../../vendor/autoload.php';
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(__DIR__.'/../php/Mokos'),
    get_include_path(),
)));