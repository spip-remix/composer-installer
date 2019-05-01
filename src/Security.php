<?php

namespace Spip\Composer;

use Composer\Script\Event;
use Composer\Util\Filesystem;

/**
 * Script for post-install-cmd and post-update-cmd.
 */
class Security
{
    /**
     * To move the security screen after download in the config directory of the project.
     *
     * @param $event 
     *
     * @return void
     */
    public static function postInstall(Event $event)
    {
        $filesystem = new Filesystem();
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');

        $filesystem->copy(
            $vendorDir . '/spip/security/ecran_securite.php',
            $vendorDir . '/../config'
        );
    }

    public static function postUpdate(Event $event)
    {
        static::postInstall($event);
    }
}
