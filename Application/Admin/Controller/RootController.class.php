<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/5/9
 * Time: 13:32
 */
namespace Admin\Controller;

use Think\Controller;

class RootController extends Controller{
    /**
     * ajax返回请求结果：成功时
     * @param string $data
     * @param string $info
     * @param number $status
     */
    protected function DefaultReturn($data = null, $info="success", $status = 200){
        $this->ajaxReturn($data, $info, $status);
    }

    /**
     * ajax返回请求结果：失败时
     * @param string $data
     * @param string $info
     * @param number $status
     */
    protected function ParamsErrorReturn($data = null, $info="Bad params", $status = 400){
        $this->ajaxReturn($data, $info, $status);
    }

    /**
     * ajax返回请求结果：服务器错误时
     * @param string $data
     * @param string $info
     * @param number $status
     */
    protected function ServerErrorReturn($data = null, $info="Server error", $status = 500){
        $this->ajaxReturn($data, $info, $status);
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    //由于项目中多次用到此函数，而官方会对其进行改动
    //故在公共控制器中覆写，以不改动官方代码，方便移植和升级
    protected function ajaxReturn($data,$type='',$json_option=0) {
        if(func_num_args()>2) {// 兼容3.0之前用法
            $args           =   func_get_args();
            array_shift($args);
            $info           =   array();
            $info['data']   =   $data;
            $info['info']   =   array_shift($args);
            $info['status'] =   array_shift($args);
            $data           =   $info;
            $type           =   $args?array_shift($args):'';
        }
        //上面代码不为官方，为了兼容增加
        if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
        switch (strtoupper($type)){
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data,$json_option));
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler.'('.json_encode($data,$json_option).');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default     :
                // 用于扩展其他返回格式数据
                Hook::listen('ajax_return',$data);
        }
    }


}