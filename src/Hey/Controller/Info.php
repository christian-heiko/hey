<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 08:41
 */

namespace Hey\Controller;


class Info extends Base
{
    public function get()
    {



        return self::render(
            'controller/info.html.twig',
            [
                'phpInfo' => $this->_getPhpInfo()
            ]
        );
    }

    protected function _getPhpInfo()
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($this->_getRawPhpInfo());

        $body = $dom->getElementsByTagName('body')->item(0);

        return $dom->saveHTML($body->firstChild);
    }

    protected function _getRawPhpInfo()
    {
        ob_start();
        phpinfo();
        $phpInfo = ob_get_contents();
        ob_end_clean();
        return $phpInfo;
    }


}