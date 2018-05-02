<?php

namespace Spip\Test\Composer;

use Composer;
use PHPUnit\Framework\TestCase;
use Spip\Composer\Classic;
use Spip\Composer\SpipInstaller;
use Spip\Test\Composer\Mocks\SpipClassic;
use Spip\Test\Composer\Mocks\SpipProject;

class SpipInstallerTest extends TestCase
{
    public function testGetInstallPath()
    {
        $spip = new SpipClassic();
        $package = $spip->getPackage();

        $io = new Composer\IO\NullIO();
        $composer = Composer\Factory::create($io);

        $spipInstaller = new SpipInstaller($io, $composer);

        $this->assertSame('./tmp/__spip_classic__', $spipInstaller->getInstallPath($package));
    }
}