<?php

namespace Spip\Test\Composer\Mocks;

use Composer\Package\Package;

class SpipClassic
{
    public function getPackage()
    {
        $package = new Package('spip/classic', '1.0', '1.0.0.0');
        $package->setType('spip-classic');

        return $package;
    }
}
