<?php

namespace Hey;

use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Rpodwika\Silex\YamlConfigServiceProvider;
use TM\ErrorLogParser\Parser;

class Application extends \Silex\Application
{

    protected $_publicRoot;

    protected $_libraryRoot;

    protected $_appRoot;

    public function __construct($publicRoot)
    {
        parent::__construct();

        $this->setPublicRoot($publicRoot);
        $this->setLibraryRoot();
        $this->setAppRoot();

        $this->_registerConfig();
        $this->_registerSilex();
        $this->_registerHey();
    }

    protected function _registerConfig()
    {
        $this->register(new YamlConfigServiceProvider($this->getLibraryRoot() . "config/settings.yml"));
        $this->register(new YamlConfigServiceProvider($this->getAppRoot() . "config/settings.yml"));
    }

    protected function _registerHey()
    {
        $this->register(new ServerCollectionProvider());
        $this->register(new NavigationProvider());
        $this->register(new ControllerProvider());
        $this->register(new ConfigTranslatorService());
    }

    protected function _registerSilex()
    {
        $this->register(new ServiceControllerServiceProvider());
        $this->register(new AssetServiceProvider());
        $this->register(new TwigServiceProvider());
        $this->register(new HttpFragmentServiceProvider());
        $this->register(new DoctrineServiceProvider(), $this['config']['db']);
    }

    /**
     * @return mixed
     */
    public function getPublicRoot()
    {
        return $this->_publicRoot;
    }

    /**
     * @param mixed $publicRoot
     */
    public function setPublicRoot($publicRoot)
    {
        $this->_publicRoot = $publicRoot . '/';
    }

    /**
     * @return mixed
     */
    public function getLibraryRoot()
    {
        return $this->_libraryRoot;
    }

    /**
     * @param string|null $libraryRoot
     */
    public function setLibraryRoot($libraryRoot = null)
    {
        $this->_libraryRoot = is_null($libraryRoot) ? __DIR__ . '/../../' : $libraryRoot;
    }

    /**
     * @return mixed
     */
    public function getAppRoot()
    {
        return $this->_appRoot;
    }

    /**
     * @param string|null $appRoot
     */
    public function setAppRoot($appRoot = null)
    {
        $this->_appRoot = is_null($appRoot) ? $this->getPublicRoot() . '../' : $appRoot;
    }



}