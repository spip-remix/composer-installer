<?php

namespace Spip\Test\Composer\Mocks;

use Composer\Package\Package;

class SpipCms
{
    public function getPackage()
    {
        $package = new Package('SPIP/Cms', '1.0', '1.0.0.0');
        $package->setType('spip-cms');

        return $package;
    }
}
