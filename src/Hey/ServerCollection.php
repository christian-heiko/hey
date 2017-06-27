<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 26.06.17
 * Time: 19:01
 */

namespace Hey;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerCollection
{

    /**
     * @var \Hey\ServerConfig
     */
    public $config;

    /**
     * @var ServerInfo[]
     */
    public $server = [];

    /**
     * ServerCollection constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->buildIndex();
    }


    /**
     *
     */
    public function buildIndex(){
        foreach($this->_findFolders() as $server) {
            if (!$server->isExcludedServer()){
                $server->buildInfo();
                $this->server[] = $server;
            }
        }
    }

    /**
     * @return ServerInfo[]
     */
    protected function _findFolders(){
        $serverPaths = glob($this->config->serversPath. '*');

        foreach($serverPaths as $serverPath){
            yield new ServerInfo(
                $serverPath,
                $this->config
            );
        }
    }
}