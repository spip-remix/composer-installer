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

        if ('spip-ecrire' === $package->getType()) {
            return './ecrire';
        }

        if ('spip-prive' === $package->getType()) {
            return './prive';
        }

        if ('spip-plugin' === $package->getType()) {
            $extra = $this->composer->getPackage()->getExtra();
            $template = $extra['spip']['template'] ?? '';
            $extensions = $extra['spip']['extensions'] ?? [];
            $name = $package->getName();

            if ($template === $name) {
                return './squelettes-dist';
            }

            if (in_array($name, $extensions)) {
                return './plugins-dist/' . $name;
            }
            
            return './plugins/' . $name;
        }

        if (in_array($package->getType(), array(
            'spip-lang',
            'spip-theme',
        ))) {
            throw new \InvalidArgumentException(
                'Unable to install this package as its type is not supported for now.'.
                ' Wait for a future SPIP version for using it.'
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return in_array($packageType, array(
            'spip-classic', //SPIP Classic a.k.a. v4.2
            //Until SPIP X.Y some packages need to be installed in some particular places
            'spip-ecrire',  //SPIP CMS Component a.k.a. spip/ecrire vX.Y
            'spip-prive',   //SPIP CMS Component a.k.a. spip/prive vX.Y
            'spip-lang',    //SPIP CMS Component a.k.a. spip/lang
            'spip-theme',   //SPIP CMS Component a.k.a. spip/theme
            'spip-plugin',  //an optional or required SPIP plugin or the default template
        ));
    }
}
