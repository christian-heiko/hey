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
            []
        );
    }


}