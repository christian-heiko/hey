<?php

namespace Hey\Controller;

class Index extends Base
{


    public function get(){
        return $this->render(
            'controller/index.html.twig',
            ['folders' => $this->_serverCollection->server]
        );
    }
}