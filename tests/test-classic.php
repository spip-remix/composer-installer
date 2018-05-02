<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Composer\Factory;
use Composer\Script\Event;
use Spip\Composer\Classic;
use Spip\Composer\SpipInstaller;
use Spip\Test\Composer\Mocks\SpipClassic;

$io = new Composer\IO\NullIO();
$composer = Factory::create($io);

$event = new Event('test', $composer, $io, true);
Classic::postInstall($event);

echo PHP_EOL;
exit(0);
