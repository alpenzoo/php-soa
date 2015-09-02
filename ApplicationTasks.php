<?php

namespace Tasks;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class ApplicationTasks {

    public static function startDevelopmentWebServer($event) {

        //$timeout = $event->getComposer()->getConfig()->get('process-timeout');
        $port = 3000;
        echo ('Starting webserver on port '. $port);
        echo exec('php -S localhost:'. $port .' public/index.php');

    }


}
