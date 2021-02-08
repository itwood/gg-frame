<?php

namespace Gg\Database;
use Illuminate\Database\Capsule\Manager;

class Database
{
    /**
     * 数据库初始化
     * @param array $config
     */
    public static function init(array $configs)
    {
        $manager =new Manager();
        foreach($configs as $name => $config) {
            $manager->addConnection($config, $name);
        }
        $manager->setAsGlobal();
        $manager->bootEloquent();
    }
}
