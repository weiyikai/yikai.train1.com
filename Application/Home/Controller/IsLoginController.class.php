<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/4/20
 * Time: 23:29
 */
namespace Home\Controller;
use Think\Controller;

class IsLoginController extends RootController{
    protected $user;
    /**
     * 构造函数进行登录检测
     */
    public function _initialize(){


        if(!isset($this->user)){//如果已经登录，username存在，直接跳过登录检测
            $this->user = session('realname');

            if(!isset($this->user)){//未登录则记录目标地址并跳转登录页面
                session('callback',__SELF__);
                $actionName = strtolower(ACTION_NAME);
                $controllerName = strtolower(CONTROLLER_NAME);
                switch($controllerName){
                    case 'order':
                        //Order控制器的所有方法都需要登录
                        $this->error('请登录',U('User/login'),1);
                        exit;
                        break;
                        //business控制器的所有方法都需要登录
                    case 'business':
                        $this->error('请登录',U('User/login'),1);
                        exit;
                        break;
                }
            }
        }
    }

    /**
     * 跳转到登录界面并设置成功登录时跳转的url
     * @param string $url 登录成功后跳转url
     * @param string $command url模式，'relative':相对路径,'absolute':绝对路径
     */
    protected function Loginto($url,$command='absolute'){
        layout(false);
        if('relative' === $command){
            $this->assign('url','../'.$url);
        }else if('absolute' === $command){
            $this->assign('url',$url);
        }
        $this->display('User:User');
    }


}

