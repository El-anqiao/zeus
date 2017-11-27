<?php
/**
 * Created by PhpStorm.
 * User: faraone
 * Date: 2017/11/27
 * Time: 下午11:13
 */
namespace App\Api;

use PhalApi\Api;

class Hello extends Api{
    /**
     *
     */
    public function world()
    {
        return ['title'=>'hello world!'];
    }
}