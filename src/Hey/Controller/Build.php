<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 00:50
 */

namespace Hey\Controller;


class Build extends Base
{
    public function get()
    {
        foreach($this->_serverCollection->server as $server){
            if (!$server->hasConfigFile() || !$server->ignoreConfigFile()){
                $server->buildConfigFile($this->_app['twig']);
            }
        }


        return $this->render(
            'controller/index.html.twig',
            ['folders' => $this->_serverCollection->server]
        );
    }


}