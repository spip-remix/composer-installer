<?php

/*echo PHP_EOL;

echo 'autoload: ';
echo "'" . __DIR__ . '/../vendor/autoload.php" ';
echo file_exists(__DIR__ . '/../vendor/autoload.php') ? 'OK' : 'KO';

echo PHP_EOL;
*/
require_once __DIR__ . '/../vendor/autoload.php';

use Composer\Factory;
use Spip\Composer\Classic;
use Spip\Composer\SpipInstaller;
use Spip\Test\Composer\Mocks\SpipCms;
use Spip\Test\Composer\Mocks\SpipExtension;
use Spip\Test\Composer\Mocks\SpipPlugin;
use Spip\Test\Composer\Mocks\SpipProject;
use Spip\Test\Composer\Mocks\SpipTemplate;

$spipProject = new SpipProject();

$io = new Composer\IO\NullIO();
$composer = Factory::create($io);
$composer->setPackage($spipProject->getPackage());

$extra = $composer->getPackage()->getExtra();
var_dump(["extra du rootPackage" => $extra]);

$mock = new SpipCms();
$package = $mock->getPackage();
var_dump(["un pacakge de type spip-cms" => $package]);

/*$extra = [
    'spip' => [
        'template' => ['jamesrezo/spip-clear'],
        'extensions' => 'test/test'
    ]
];

$extra = [
    'spip' => [
        'template' => 'jamesrezo/spip-clear',
        'extensions' => ['test/test']
    ]
];

$extra = [
    'spip' => []
];*/

$template = isset($extra['spip']['template']) ? $extra['spip']['template'] : '';
$extensions = isset($extra['spip']['extensions']) ? $extra['spip']['extensions'] : [];

echo PHP_EOL;
echo 'extra: ';
echo PHP_EOL;
echo 'template: "';
echo is_string($template) ? $template : '';
echo '"';
echo PHP_EOL;
echo 'extensions: (';
echo is_array($extensions) ? implode(', ', $extensions) : '';
echo ')';

$spipInstaller = new SpipInstaller($io, $composer);
try {
    $path = $spipInstaller->getInstallPath($package);
} catch (Exception $e) {
    $path = '';
    var_dump($e->getMessage());
}
echo 'path: "' . $path. '"';
echo PHP_EOL;

$mock = new SpipPlugin();
$package = $mock->getPackage();
try {
    $path = $spipInstaller->getInstallPath($package);
} catch (Exception $e) {
    $path = '';
    var_dump($e->getMessage());
}
echo 'path: "' . $path. '"';
echo PHP_EOL;

$mock = new SpipExtension();
$package = $mock->getPackage();
try {
    $path = $spipInstaller->getInstallPath($package);
} catch (Exception $e) {
    $path = '';
    var_dump($e->getMessage());
}
echo 'path: "' . $path. '"';
echo PHP_EOL;

$mock = new SpipTemplate();
$package = $mock->getPackage();
try {
    $path = $spipInstaller->getInstallPath($package);
} catch (Exception $e) {
    $path = '';
    var_dump($e->getMessage());
}
echo 'path: "' . $path. '"';
echo PHP_EOL;

echo PHP_EOL;
exit(0);
