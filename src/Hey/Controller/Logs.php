<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 00:17
 */

namespace Hey\Controller;


class Logs extends Base
{

    protected $_parser;

    public function get()
    {

        $logs = $this->_parseErrorLog();

        return $this->render('controller/logs.html.twig', ['logs' => array_reverse($logs)]);
    }



    protected function _parseErrorLog(){
        $lines = [];
        $matches = [];
        $content = file_get_contents($this->_app['hey.servers']->config->errorLogPath);
        preg_match_all('/([0-9]{4}\/{1}[0-9]{2}\/{1}[0-9]{2}.*)/', $content, $matches);
        return $matches[0];
    }

}