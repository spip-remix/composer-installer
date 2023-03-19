<?php

namespace Spip\Test\Composer;

use Composer;
use Composer\Composer as ComposerObject;
use Composer\IO\IOInterface;
use Composer\Package\Package;
use Composer\Package\RootPackage;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Spip\Composer\Classic;
use Spip\Composer\SpipInstaller;
use Spip\Test\Composer\Mocks\SpipClassic;
use Spip\Test\Composer\Mocks\SpipProject;

/**
 * @covers Spip\Composer\SpipInstaller
 */
class SpipInstallerTest extends TestCase
{
    private SpipInstaller $installer;

    protected function setUp(): void
    {
        $io = new Composer\IO\NullIO();
        $composer = Composer\Factory::create($io);
        $package = new RootPackage('spip/spip', '1.0', '1.0.0.0');
        $package->setExtra([
            'spip' => [
                'template' => 'spip/default-template',
                'extensions' => [
                    'spip/mandatory',
                ],
            ],
        ]);
        $composer->setPackage($package);        

        $this->installer = new SpipInstaller($io, $composer);        
    }

    public static function dataPluginTypes()
    {
        return [
            'library' => [
                'expected' => null,
                'name' => 'spip/test',
                'type' => 'library',
                
            ],
            'classic' => [
                'expected' => './tmp/__spip_classic__',
                'name' => 'spip/test',
                'type' => 'spip-classic',
            ],
            'ecrire' => [
                'expected' => './ecrire',
                'name' => 'spip/test',
                'type' => 'spip-ecrire',
            ],
            'prive' => [
                'expected' => './prive',
                'name' => 'spip/test',
                'type' => 'spip-prive',
            ],
            'plugin' => [
                'expected' => './plugins/spip/test',
                'name' => 'spip/test',
                'type' => 'spip-plugin',
            ],
            'extension' => [
                'expected' => './plugins-dist/spip/mandatory',
                'name' => 'spip/mandatory',
                'type' => 'spip-plugin',
            ],
            'template' => [
                'expected' => './squelettes-dist',
                'name' => 'spip/default-template',
                'type' => 'spip-plugin',
            ],
        ];
    }

    /**
     * @dataProvider dataPluginTypes
     */
    public function testSupports($expected, $name, $type)
    {
        $package = new Package($name, '1.0.0', '1.0.0.0');
        $package->setType($type);

        $this->assertEquals(!is_null($expected), $this->installer->supports($package->getType()));
    }

    /**
     * @dataProvider dataPluginTypes
     */
    public function testGetInstallPath($expected, $name, $type)
    {
        $package = new Package($name, '1.0.0', '1.0.0.0');
        $package->setType($type);

        $this->assertSame($expected, $this->installer->getInstallPath($package));
    }

    public function testUnsupportedType()
    {
        $this->expectException(InvalidArgumentException::class);
        $package = new Package('spip/test', '1.0.0', '1.0.0.0');
        $package->setType('spip-lang');

        $this->installer->getInstallPath($package);
    }
}