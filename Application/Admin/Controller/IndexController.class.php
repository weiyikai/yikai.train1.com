<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends RootController {
    /**
     * 首页
     */
    public function index(){
        $this->display();
    }
}