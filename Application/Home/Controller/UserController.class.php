<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/4/20
 * Time: 23:23
 */
namespace Home\Controller;
use Think\Controller;

class UserController extends RootController{
    /**
     * 登录
     */
    public function login(){
        layout(false);
        $this->display();
    }

    /**
     * 注册
     */
    public function register(){
        layout(false);
        $this->display();
    }

    /**
     * 注册处理
     */
    public function doRegister(){
        if(!IS_POST || !IS_AJAX){
            $this->error('非法访问');exit;
        }
        $register_data = I('post.');
        if(empty($register_data)){
            $this->DefaultReturn(0,'系统未检测到有数据提交',500);exit;
        }

        $user = M('User');
        $where['username'] = $register_data['acc'];
        $res = $user->where($where)->field('username')->find();
        if($res !== null){
            $this->DefaultReturn(0,'账号已存在',500);exit;
        }

        $where2['username'] = $register_data['acc'];

        $add['username'] = $register_data['acc'];
        $add['password'] = $register_data['password'];
        $add['createdAt'] = date('Y-m-d',time());
        $add['realname'] = $register_data['realname'];
        $add['sfz'] = $register_data['sfz'];
        $add['tel'] = $register_data['telephone'];

        if($user->create($add)){
            $res = $user->where($add)->add();
            if(!$res){
                $this->DefaultReturn(0,'注册失败',500);exit;
            }
            $this->DefaultReturn(0,'注册成功',200);
        }
    }

    /**
     * 登录处理
     */
    public function doLogin_test(){
        if(!IS_AJAX || !IS_POST){
            $this->error('非法访问');exit;
        }
        $request_data = I('post');

        if(empty($request_data)){
            $this->DefaultReturn(0,'系统未检测到有数据提交',500);
        }

        $user = M('User');
        $where['username'] = $request_data['username'];
        $res = $user->where($where)->find();

        if(!$res){

        }
    }
    public function doLogin(){
        if(!IS_POST || !IS_AJAX){
            $this->error('非法访问');exit;
        }
        $request_data = I('post.');

        if(empty($request_data)){
            $this->DefaultReturn(0,'系统未检测到有数据提交',500);exit;
        }


        $user = M('User');
        $where['username'] = $request_data['username'];
        $res = $user->where($where)->find();


        if(!$res){
            $this->DefaultReturn(0,'账号不存在',500);exit;
        }

        if($res['password'] !== $request_data['password']){
            $this->DefaultReturn(0,'密码错误',500);exit;
        }

        session('realname',$res['realname']);
        session('userId',$res['userId']);



        $user = M('User');
        $where1['userId'] = session('userId');
        $res1 = $user->where($where1)->select();

        session('money',$res1[0]['money']);


        $callback = session('callback');
        $result = empty($callback) ? U('Index/index') : $callback;
        $this->DefaultReturn($result,'登录成功',200);
    }

    /**
     * 退出登录
     */
    public function logout(){
        if(!session('realname')){
            $this->error('请登录');
        }
        session_destroy();
        $this->success('注销成功',U('Index/index'));
    }



}