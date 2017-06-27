<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 26.06.17
 * Time: 21:35
 */

namespace Hey;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerProvider implements ServiceProviderInterface
{


    public function register(Container $app)
    {
        $first = true;
        foreach ($app['config']['routing'] as $key => $route) {
            $route['key'] = $key;
            $serviceName = 'hey.controller.' . $key;

            $app[$serviceName] = function() use($app, $route){
                return new $route['controller'](
                    $app['hey.servers'],
                    $app,
                    $route
                );
            };

            $app['navigation']->addItem($key, $route);

            $app->get('/' . $key, $serviceName . ':get');

            if ($first) {
                $app->get('/', function() use ($app, $key) {
                    return $app->redirect('/' . $key);
                })->bind('homepage');
                $first = false;
            }
        }

//        $app->error(function (\Exception $e, Request $request, $code) use ($app) {
//            // 404.html, or 40x.html, or 4xx.html, or error.html
//            $templates = array(
//                'errors/'.$code.'.html.twig',
//                'errors/'.substr($code, 0, 2).'x.html.twig',
//                'errors/'.substr($code, 0, 1).'xx.html.twig',
//                'errors/default.html.twig',
//            );
//
//            return new Response($app['twig']->resolveTemplate($templates)->render(array(
//                'code'      => $code,
//                'error'   => (object)$e
//            )), $code);
//        });
    }


}