<?php

namespace Spip\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class SpipInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        if ('spip-classic' === $package->getType()) {
            return './tmp/__spip_classic__';
        }

        if (in_array($package->getType(), array(
            'spip-ecrire',
            'spip-prive',
            'spip-cms',
            'spip-lang',
            'spip-theme',
            'spip-plugin'
        ))) {
            throw new \InvalidArgumentException(
                'Unable to install this package as its type is not supported for now.'.
                ' Wait for SPIP3.3 for using it.'
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return in_array($packageType, array(
            'spip-classic', //SPIP Classic a.k.a. v3.0 to v3.2
            //Until SPIP 4.0 some packages need to be installed in some particular places
            'spip-cms',     //SPIP CMS Component v3.4+ a.k.a. spip/cms
            'spip-ecrire',  //SPIP CMS Component a.k.a. spip/ecrire v3.3
            'spip-prive',   //SPIP CMS Component a.k.a. spip/prive v3.3
            'spip-lang',    //SPIP CMS Component a.k.a. spip/lang v3.3
            'spip-theme',   //SPIP CMS Component a.k.a. spip/theme v3.3
            'spip-plugin',  //an optional or required SPIP plugin or the default template
        ));
    }
}
