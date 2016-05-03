<?php

namespace Tohuma\Laravel\Routes;

use Composer\Script\Event;

class ComposerScripts 
{
    public static function postInstall(Event $event)
    {
        $source = __DIR__ .'/Config/routes.php';
        $destiny = __DIR__ .'/../../../../config/routes.php';
        copy( $source, $destiny );

        $event->getIO()->write("File routes.php was copied in config/routes.php");
    }
}
