<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/4/21
 * Time: 0:50
 */
namespace Home\Controller;
use Think\Controller;

class OrderController extends IsLoginController
{
    private $time;
    private $seat;

    public function index()
    {
        //获取get参数
        $request_data = I('get.');//车次拿到

        if (empty($request_data)) {
            $this->error('系统未检测到有数据提交');
            exit;
        }
        $where1['train_no'] = $request_data['train_no'];
        $where1['begin_date'] = session('begin_date');



        //车次信息概览
        $trainsinfo = M('TrainsInfo');
        $res1 = $trainsinfo->where($where1)->select();

        $this->assign('order_trainsinfoList', $res1);


        //乘客信息概览
        $tourist = M('Tourist');
        $where['userId'] = session('userId');
        $where['is_delete'] = 0;
        $res = $tourist->where($where)->select();


        $this->assign('order_touristList',$res);
        $this->display();
    }


    /*暂时废除
    //添加乘客信息处理
    public function doTouristAdd()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }
        $request_data = I('post.');


        //将得到的表单值写入tourist表中
        $tourist = M('Tourist');
        $data1['userId'] = session('userId');
        $data1['realname'] = $request_data['realname'];
        $data1['sfz'] = $request_data['sfz'];
        $data1['tel'] = $request_data['tel'];




        //首先检查所输入的乘客信息是否已经存在
        $res = $tourist->where($data1)->select();

        //完全没有此乘客信息时
        if (!$res) {

            if (!$tourist->create($data1)) {
                $this->DefaultReturn(array('data'=>'额.'), '新增失败(数据库写入异常)', 500);
                exit;
            }
            $tourist->add();
            $where11['sfz'] = $request_data['sfz'];
            $where11['userId'] = session('userId');
            $res11 = $tourist->where($where11)->find();

            $this->DefaultReturn(array('data'=>'额.'), '新增成功', 200);
            exit;
        }



        if($res[0]['orderId'] != null && $res[0]['trainId'] != 0 && $res[0]['is_display'] == 0){//虽然存在但是不可以被显示在本日本车次可购票乘客列表中的

            $this->DefaultReturn(array('data'=>$res[0]['realname']), '，已经提交过【'.session('begin_date').'】下
            $this->DefaultReturn(array('data'=>$res[0]['realname']), '，已经提交过【'.session('begin_date').'】下
                关于本车次的订单，请选择其他发车时间或【'.session('begin_date').'】下的其他车次', 500);
                exit;
        }else{
            //存在乘客信息但是is_delete为1时,表示此乘客信息已存在,不可重复添加

            $where['id'] = $res[0]['id'];
            $data2['is_delete'] = 0;
            //存在乘客信息但是is_delete为1时，只需更新is_delete为0即可完成增加
            if ($res[0]['is_delete'] == 1) {
                if (!$tourist->create($data2)) {
                    $this->DefaultReturn(array('data'=>'额.'), '新增失败(数据库写入异常)', 500);
                    exit;
                }
                $tourist->where($where)->save();
                $this->DefaultReturn(0, '新增成功', 200);
                exit;
            }else{
                $this->DefaultReturn(array('data'=>'额.'), '新增失败(此乘客信息已存在,不可重复添加)', 500);
                exit;
            }
        }

    }



        //删除指定的乘客信息处理 本质:将is_delete由0变为1
        public function doTouristDel()
        {
            if (!IS_POST || !IS_AJAX) {
                $this->error('非法访问');
                exit;
            }
            $request_data = I('post.');

            $tourist = M('Tourist');
            $where['userId'] = session('userId');
            $where['realname'] = $request_data['realname'];
            $where['sfz'] = $request_data['sfz'];
            $where['tel'] = $request_data['tel'];
            $del['is_delete'] = 1;//删除了


            //这里不用判断乘客是否存在，因为我要确保的是我的增加操作一定是无误的
            if ($tourist->create($del)) {
                $tourist->where($where)->save();
                $this->DefaultReturn(0, '删除成功', 200);
            } else {
                $this->DefaultReturn(0, '删除失败(数据库异常)', 500);
                exit;
            }
        }
*/
        /**
         * 处理订单的提交
         */
        public function doSubOrder()
        {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }
        $request_data = I('post.');


        //乘客人数检测（1<= 人数 <= 5为正常）
        $tourist = M('Tourist');
        $where['userId'] = session('userId');
        $where['is_delete'] = 0;
        $res = $tourist->where($where)->select();

        //车次信息获取
        $trainsinfo = M('TrainsInfo');
        $where1['train_no'] = $request_data['train_no'];
        $where1['begin_date'] = session('begin_date');
        $res1 = $trainsinfo->where($where1)->find();


        $seat_type1[1] = '硬座';
        $seat_type1[0] = '软座';
        //最先判断座位类型对应的座位数是否已经为0
        switch ($request_data['seat_type']) {
            case 1:
                $cur_seat_type = $seat_type1[$request_data['seat_type']];
                if ($res1['hard_remain'] <= 0) {
                    $this->DefaultReturn(array('data' => '额.'), '提交失败(您选的' . $cur_seat_type . '已售空),请换其他类型的座位', 500);
                    exit;
                }
                break;
            case 0:
                $cur_seat_type = $seat_type1[$request_data['seat_type']];
                if ($res1['soft_remain'] <= 0) {
                    $this->DefaultReturn(array('data' => '额.'), '提交失败(您选的' . $cur_seat_type . '已售空),请换其他类型的座位', 500);
                    exit;
                }
                break;
        }

        if (count($res) >= 1 && count($res) <= 5) {

            $seat_type[0] = 'soft_remain';
            $seat_type[1] = 'hard_remain';
            if (count($res) > $res1[$seat_type[$request_data['seat_type']]]) {
                $this->DefaultReturn(array('data' => '额.'), '提交失败(乘客人数多余剩余座位数),请联系管理员', 500);
                exit;
            } else {
                //用户信息获取
                $user = M('User');
                $where2['userId'] = session('userId');
                $res2 = $user->where($where2)->find();

                //订单金额计算
                $order_money = 0;//默认为0
                switch ($request_data['seat_type']) {
                    case 1:
                        $order_money = $res1['hard_price'] * count($res);
                        break;
                    case 0:
                        $order_money = $res1['soft_price'] * count($res);
                        break;
                }


                //向train_my_order写入订单信息
                $myorder = M('MyOrder');
                $data['is_delete'] = 0;
                $data['order_status'] = 0;
                $data['createdAt'] = time();
                $data['train_no'] = $res1['train_no'];
                $data['fromStation'] = session('fromStation');
                $data['toStation'] = session('toStation');
                $data['begin_date'] = session('begin_date');
                $data['username'] = $res2['username'];
                $data['realname'] = $res2['realname'];
                $data['sfz'] = $res2['sfz'];
                $data['tel'] = $res2['tel'];
                $data['seat_type'] = $request_data['seat_type'];//座位类型 1:硬座 0:软座
                $data['seat_total_num'] = count($res);
                $data['order_money'] = $order_money;


                if (!$myorder->create($data)) {
                    $this->DefaultReturn(array('data' => '额.'), '提交失败(数据库异常),请联系管理员', 500);
                    exit;
                } else {

                    for ($x = 0; $x < count($res); $x++) {
                        if($res[$x]['trainId'] == $res1['id']){
                            $this->DefaultReturn(array('data' => $res[$x]['realname']), '已经购买过'.session('begin_date').'本车次的车票', 500);
                            exit;
                        }
                    }

                    for ($i = 0; $i < count($res); $i++){
                        $orderId = $myorder->add();
                        //向tourist写入对于的trainId和orderId
                        $where3['id'] = $res[$i]['id'];
                        $data1['trainId'] = $res1['id'];
                        $data1['orderId'] = $orderId;
//                            $data1['is_delete'] = 1;

                        if (!$tourist->create($data1)) {
                            $this->DefaultReturn(array('data' => '额.'), '提交失败(数据库异常),请联系管理员', 500);
                            exit;
                        }
                        $tourist->where($where3)->save();
                    }

                    $this->DefaultReturn(0, '提交成功', 200);
                    exit;
                }
            }
        } else {
            $this->DefaultReturn(array('data' => '额.'), '提交失败(乘客人数应在1-5范围内),请联系管理员', 500);
            exit;
        }

        }

        /**
         * 支付页面
         */
        public function pay()
        {
            //获取get参数
            $request_data = I('get.');
            if (empty($request_data)) {
                $this->error('系统未检测到有数据提交');
                exit;
            }
            //车次信息获取
            $trainsinfo = M('TrainsInfo');
            $where['train_no'] = $request_data['train_no'];
            $where['begin_date'] = session('begin_date');
            $res = $trainsinfo->where($where)->select();


            //乘客信息获取
            $tourist = M('Tourist');
            $where1['userId'] = session('userId');
            $where1['is_delete'] = 0;
            $res1 = $tourist->where($where1)->select();


            //座位信息获取(座位类型+座位数量)
            $seat_type[0] = '软座';
            $seat_type[1] = '硬座';

            $seat_info[0]['seat_type'] = $seat_type[$request_data['seat_type']];
            $seat_info[0]['seat_num'] = count($res1);

            //订单金额计算
            $order_money = 0;//默认为0
            switch ($seat_info[0]['seat_type']) {
                case '硬座':
                    $order_money = $res[0]['hard_price'] * count($res1);
                    break;
                case '软座':
                    $order_money = $res[0]['soft_price'] * count($res1);
                    break;
            }


            //assign
            //车次信息assign
            $this->assign('pay_trainsinfoList', $res);
            //座位信息assign
            $this->assign('pay_seatinfoList', $seat_info);
            //乘客信息assign
            $this->assign('pay_touristList', $res1);
            //订单金额assign
            $this->assign('order_money', $order_money);

            $this->display();
        }

        /**
         * 处理订单的取消
         */
        public function doOrderCancel(){
            if (!IS_POST || !IS_AJAX) {
                $this->error('非法访问');exit;
            }

            $request_data = I('post.');
            $tourist = M('Tourist');
            $where['orderId'] = $request_data['orderId'];

            if(!$tourist->where($where)->delete()){
                $this->DefaultReturn(0,'取消订单异常，请联系管理员',500);exit;
            }

            $my_order = M('MyOrder');
            $where1['orderId'] = $request_data['orderId'];
            $data1['is_delete'] = 1;
            if(!$my_order->create($data1)){
                $this->DefaultReturn(0,'取消订单异常，请联系管理员',500);exit;
            }
            $my_order->where($where1)->save();
            $this->DefaultReturn(0,'取消成功',200);exit;
        }
        /**
         * 处理乘客信息的移除
         */
        public function doTouristMove(){
            if (!IS_POST || !IS_AJAX) {
                $this->error('非法访问');exit;
            }

            $request_data = I('post.');

            $tourist = M('Tourist');

            $where['id'] = $request_data['id_move'];
            $data['is_delete'] = 1;
            if(!$tourist->create($data)){
                $this->DefaultReturn(0,'移除异常',500);exit;
            }
            $tourist->where($where)->save();
            $this->DefaultReturn(0,'移除成功',200);exit;
        }
}