<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/4/12
 * Time: 18:24
 */
return array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'train',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'train_',    // 数据库表前缀
    'DB_PARAMS'             =>array(
        PDO::ATTR_CASE      => PDO::CASE_NATURAL
    )
);