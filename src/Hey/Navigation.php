<?php
/**
 * Created by PhpStorm.
 * User: christian-heiko
 * Date: 27.06.17
 * Time: 00:23
 */

namespace Hey;


class Navigation
{
    public $items = [];

    public function addItem($key, array $route){
        $this->items[$key] = (object)[
            'key' => $key,
            'route' => '/' . $key,
            'title' => $route['title'],
            'active' => $this->items == 0
        ];
    }

    public function setActive($key){
        foreach($this->items as $item){
            $item->active = false;
        }
        $this->items[$key]->active = true;
    }
}