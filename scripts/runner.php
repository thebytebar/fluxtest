<?php

if (php_sapi_name() !== 'cli') {
    http_response_code(404);
    exit();
}

require_once __DIR__ . '/../../../autoload.php';

$options = getopt('', ['dir:', 'ext:']);
$dir = isset($options['dir']) ? $options['dir'] : '/.';
$fileExt = isset($options['ext']) ? $options['ext'] : '.TestCase.php';

$dir = __DIR__ . '/../../../..' . $dir;
$suite = new TheByteBar\FluxTest\Suite($dir, $fileExt);
$suite->run();

// {C} thebytebar.com
