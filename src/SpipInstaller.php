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
            $template = isset($extra['spip']['template']) ? $extra['spip']['template'] : '';
            $template = is_string($template) ? $template : '';
            $extensions = isset($extra['spip']['extensions']) ? $extra['spip']['extensions'] : [];
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
                ' Wait for SPIP3.4+ for using it.'
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
            'spip-ecrire',  //SPIP CMS Component a.k.a. spip/ecrire v3.3
            'spip-prive',   //SPIP CMS Component a.k.a. spip/prive v3.3
            'spip-lang',    //SPIP CMS Component a.k.a. spip/lang v3.4
            'spip-theme',   //SPIP CMS Component a.k.a. spip/theme v3.4
            'spip-plugin',  //an optional or required SPIP plugin or the default template
        ));
    }
}
