<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 26.06.17
 * Time: 19:02
 */

namespace Hey;


class ServerConfig
{
    public $serversPath;

    public $configsPath;

    public $errorLogPath;

    public $devDomainName;

    public $excludedServers = [];

    public $publicFolders = ['web', 'public'];

    public $infoFiles = ['package.json', 'composer.json'];

    public $excludedDbs = ['information_schema', 'mysql', 'performance_schema'];

    /**
     * @param array $config
     * @return ServerConfig
     */
    public static function initByArray(array $config){
        $configInstance = new self();
        foreach($config as $key => $value) {
            $configInstance->{$key} = $value;
        }
        return $configInstance;
    }

    public function excludeServer($name){
        $this->excludedServers[] = $name;
        return $this;
    }

    public function addPublicFolderName($name){
        $this->publicFolders[] = $name;
    }

    public function addInfoFileName($name) {
        $this->infoFiles[] = $name;
    }

    public function excludeDb($name) {
        $this->excludedDbs[] = $name;
    }
}