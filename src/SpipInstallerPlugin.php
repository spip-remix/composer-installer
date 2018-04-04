<?php

namespace Spip\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class SpipInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new SpipInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
