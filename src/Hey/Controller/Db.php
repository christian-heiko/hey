<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 00:11
 */

namespace Hey\Controller;


class Db extends Base
{
    public function get()
    {
        $tables = [];
        $allTables = $this->_app['db']->fetchAll('SHOW DATABASES');
        foreach ($allTables as $table){
            if (!in_array($table['Database'], $this->_app['hey.servers']->config->excludedDbs)) {
                $tables[] = $table;
            }
        }

        return $this->render(
            'controller/db.html.twig',
            array('dbList' => $tables)
        );
    }


}