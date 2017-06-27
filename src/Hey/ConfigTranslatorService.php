<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 01:29
 */

namespace Hey;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigTranslatorService implements ServiceProviderInterface
{

    public function register(Container $app)
    {

        $app['twig.path'] = array($app->getLibraryRoot() . 'templates');
        $app['twig.options'] = array('cache' => $app->getAppRoot() . 'var/cache/twig');

        $app['debug'] = $app['config']['general']['debug'];
    }

}