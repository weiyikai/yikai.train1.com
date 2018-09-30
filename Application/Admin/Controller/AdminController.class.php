<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/4/10
 * Time: 20:47
 */
namespace Admin\Controller;

use Think\Controller;

class AdminController extends RootController{
    /**
     * 登录
     */
    public function login(){
        layout(false);
        $this->display();
    }

    /**
     * 处理登录
     */
    public function doLogin(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }

        $request_date = I('post.');

        $admin = M('Admin');
        $where['username'] = $request_date['username'];
        $res = $admin->where($where)->find();
        if(!$res){
            $this->DefaultReturn(0,'用户名不存在',500);exit;
        }
        //用户名存在的话
        if($res['password'] !== $request_date['password']){
            $this->DefaultReturn(0,'密码错误',500);exit;
        }
        session('admin_username',$res['username']);
        $this->DefaultReturn(0,'登录成功',200);exit;
    }

    /**
     * 注销
     */
    public function logout(){
        session_destroy();
        $this->success('注销成功',U('Admin/Admin/login'));
    }
}