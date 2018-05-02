<?php

namespace Spip\Test\Composer\Mocks;

use Composer\Package\Package;

class SpipPlugin
{
    public function getPackage()
    {
        $package = new Package('spip/test', '1.0', '1.0.0.0');
        $package->setType('spip-plugin');

        return $package;
    }
}
