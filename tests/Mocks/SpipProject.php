<?php

namespace Spip\Test\Composer\Mocks;

use Composer\Package\RootPackage;

class SpipProject
{
    public function getPackage()
    {
        $package = new RootPackage('spip/spip', '1.0', '1.0.0.0');
        $package->setType('project');
        $package->setExtra(array(
            'spip' => array(
                'template' => 'spip/dist',
                'extensions' => array(
                    'spip/organiseur',
                    'spip/mots',
                    'spip/filtre_images'
                )
            )
        ));

        return $package;
    }
}
