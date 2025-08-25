<?php

if (php_sapi_name() !== 'cli') {
    http_response_code(404);
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';

$dir = __DIR__ . '/../src';
$suite = new TheByteBar\FluxTest\Suite($dir, '.TestCase.php');
$suite->run();

// {C} thebytebar.com
