<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 26.06.17
 * Time: 18:57
 */

namespace Hey;


class ServerInfo
{
    /**
     * @var string
     */
    public $path;
    /**
     * @var string
     */
    public $relativePath;
    /**
     * @var string
     */
    public $url;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $publicPath;

    /**
     * @var string
     */
    public $configPath;

    /**
     * @var string[]
     */
    public $domains;

    /**
     * @var bool
     */
    public $built = false;

    /**
     * @var ServerConfig
     */
    public $config;

    /**
     * ServerInfo constructor.
     * @param $folderPath
     * @param ServerConfig $config
     */
    public function __construct($folderPath, ServerConfig $config)
    {
        $this->path = $folderPath;
        $this->config = $config;
        $this->buildPaths();
    }

    /**
     *
     */
    public function buildPaths()
    {
        $this->relativePath = $this->_getRelativePath($this->path);
        $this->name = $this->relativePath;
        $this->publicPath = $this->path;
        $this->configPath = $this->config->configsPath . $this->relativePath . '.conf';
        $this->domains = [
            $this->relativePath . '.' . $this->config->devDomainName,
            'www.' . $this->relativePath . '.' . $this->config->devDomainName,
            $this->relativePath . '.localhost'
        ];
    }

    public function buildInfo(){
        $this->findPathInfo();
        $this->findPublicPath();
    }

    public function findPublicPath()
    {
        foreach ($this->config->publicFolders as $public) {
            $publicPath = $this->path . $public;
            if (is_dir($publicPath)){
                $this->publicPath = $publicPath;
            }
        }
    }

    public function findPathInfo()
    {
        foreach($this->config->infoFiles as $infoFile) {
            $fileName = $this->path . '/' . $infoFile;
            if (file_exists($fileName)) {
                $this->_parseInfoFile($fileName);
            }
        }
    }

    public function buildConfigFile($twig){
        file_put_contents(
            $this->configPath,
            $twig->render('conf/template.conf.twig', [
                'info' => $this
            ])
        );
        $this->built = true;
    }

    /**
     * @return bool
     */
    public function hasConfigFile(){
        return file_exists($this->configPath);
    }

    /**
     * @return bool
     */
    public function ignoreConfigFile(){
        return strpos(fgets(fopen($this->configPath, 'r')), '#leave') !== false;
    }

    /**
     * @return bool
     */
    public function isExcludedServer()
    {
        return in_array($this->relativePath, $this->config->excludedServers);
    }

    /**
     * @param $folderPath
     * @return string
     */
    protected function _getRelativePath($folderPath)
    {
        return str_replace($this->config->serversPath, '', $folderPath);
    }

    /**
     * @param $infoFileName
     */
    protected function _parseInfoFile($infoFileName)
    {
        $data = file_get_contents($infoFileName);
        $folderData = json_decode($data);

        if(!is_null($folderData) && is_object($folderData)){
            foreach(['name', 'description'] as $key) {
                if (isset($folderData->{$key}) && !is_null($folderData->{$key})){
                    $this->{$key} = $folderData->{$key};
                }
            }
        }
    }


}