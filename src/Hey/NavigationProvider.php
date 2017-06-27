<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 01:10
 */

namespace Hey;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class NavigationProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['navigation'] = function () use ($app){
            return new Navigation;
        };
    }


}