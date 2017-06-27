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
        $this->_parser =  new Parser(Parser::TYPE_NGINX);
        $logs = $this->_parseErrorLog();

        return $this->render('controller/logs.html.twig', ['logs' => $logs]);
    }


    protected function _loadErrorLog($fileName)
    {
        $f = fopen($fileName, 'r');
        if (!$f) throw new Exception();
        while ($line = fgets($f)) {
            yield $line;
        }
        fclose($f);
    }


    protected function _parseErrorLog(){
        $lines = [];
        foreach($this->_loadErrorLog($this->_app['hey.servers']->config->errorLogPath) as $line) {
            $lines[] = $this->_parser->parse($line);
        }
        return $lines;
    }

}