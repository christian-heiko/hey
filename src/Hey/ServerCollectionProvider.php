<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 01:08
 */

namespace Hey;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerCollectionProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['hey.servers'] = function() use ($app){
            return new ServerCollection(
                ServerConfig::initByArray($app['config']['server'])
            );
        };
    }


}