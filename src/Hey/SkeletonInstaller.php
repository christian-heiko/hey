<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 13:16
 */

namespace Hey;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class SkeletonInstaller
{
    public static function postPackageInstall()
    {


    }

    public static function postAutoloadDump(Event $event)
    {
        $libraryPath = $event->getComposer()->getConfig()->get('vendor-dir') . 'christian-heiko/hey/';
        $publicPath = $event->getComposer()->getConfig()->get('vendor-dir') . '../web/';
    }
}