<?php

namespace Spip\Test\Composer\Mocks;

use Composer\Package\Package;

class SpipExtension
{
    public function getPackage()
    {
        $package = new Package('spip/mots', '1.0', '1.0.0.0');
        $package->setType('spip-plugin');

        return $package;
    }
}
