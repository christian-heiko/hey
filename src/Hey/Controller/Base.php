<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 26.06.17
 * Time: 19:39
 */

namespace Hey\Controller;

use Hey\ServerCollection;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;

abstract class Base
{

    /**
     * @var ServerCollection
     */
    protected $_serverCollection;

    /**
     * @var \Silex\Application
     */
    protected $_app;

    protected $_route;

    public function __construct(ServerCollection $serverCollection, Application $app, array $route)
    {
        $this->_serverCollection = $serverCollection;
        $this->_app = $app;
        $this->_route = (object)$route;

        $app['navigation']->setActive($this->_route->key);
    }

    /**
     * @return mixed
     */
    public abstract function get();

    /**
     * @param $templatePath
     * @param array $data
     * @return mixed
     */
    public function render($templatePath, array $data = [])
    {
        return $this->_app['twig']->render(
            $templatePath, $data
        );
    }

}