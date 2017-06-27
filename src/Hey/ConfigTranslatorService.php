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

    /**
     * @var \Hey\Application
     */
    protected $_app;

    public function register(Container $app)
    {

        $this->_app = $app;

        $app['debug'] = $app['config']['general']['debug'];
        $app['twig.path'] = $this->_preparePaths($app['config']['twig']['templatePaths']);
        $app['twig.options'] = [
            'cache' => $this->_preparePath(
                $app['config']['twig']['cachePath']
            )
        ];
    }

    protected function _preparePaths($paths)
    {
        return array_map([$this, '_preparePath'], $paths);
    }


    protected function _preparePath($path){
        foreach([
            'libraryRoot' => $this->_app->getLibraryRoot(),
            'publicRoot' => $this->_app->getPublicRoot(),
            'appRoot' => $this->_app->getAppRoot()
                ] as $var => $value){
            $path = str_replace($var . ':', $value, $path);
        }
        return $path;
    }
}