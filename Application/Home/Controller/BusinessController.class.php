<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/5/1
 * Time: 11:02
 */
namespace Home\Controller;
use Think\Controller;

class BusinessController extends IsLoginController
{

    private $time;
    private $seat;
    private $time1;
    private $seat1;
    private $time2;
    private $seat2;
    private $time3;
    private $seat3;
    private $time4;
    private $seat4;


    /**
     * 充值
     */
    public function pay()
    {
        $request_data = session('userId');

        $user = M('User');
        $where['userId'] = $request_data;
        $res = $user->where($where)->select();

        $this->assign('user_payList', $res);

        $this->display();
    }

    /**
     * 余额查询
     */
    public function remainMoney()
    {
        $request_data = session('userId');

        $user = M('User');
        $where['userId'] = $request_data;
        $res = $user->where($where)->select();

        $this->assign('user_moneyList', $res);
        $this->display();
    }

    /**
     * 处理充值
     */
    public function doPay()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }
        $request_data = I('post.');

        if($request_data['pay_money'] < 0){
            $this->DefaultReturn(0, '金额不能为负数', 500);
            exit;
        }
        $user = M('User');
        $where['userId'] = session('userId');
        $data['pay_money'] = $request_data['pay_money'];
        if (!$user->create($data)) {
            $this->DefaultReturn(0, '充值失败', 500);
            exit;
        }
        $user->where($where)->save();//将pay_money写入

        $res = $user->where($where)->find();//取出原来的金额money和待充金额pay_money（后台）
        $now_money = $res['money'] + $res['pay_money'];//求充值后的金额
        $data1['money'] = $now_money;
        if (!$user->create($data1)) {
            $this->DefaultReturn(0, '充值失败', 500);
            exit;
        }
        $user->where($where)->save();//将充值后的金额now_money写入money字段（后台）

        session('money', session('money') + $res['pay_money']);//在pay_money为0前，更新钱包session('money')(前台)

        $data2['pay_money'] = 0;
        if (!$user->create($data2)) {
            $this->DefaultReturn(0, '充值失败', 500);
            exit;
        }
        $user->where($where)->save();//将充值后的金额now_money写入money字段后，清空pay_money字段（后台）
        $this->DefaultReturn(0, '充值成功', 200);
        exit;
    }

    /**
     * 我的订单显示
     */
    public function my_order()
    {


        $myorder = M('MyOrder');
        //待支付订单显示
        $where['realname'] = session('realname');//当前用户下的
        $where['is_delete'] = 0;//正常票
        $where['order_status'] = 0;//待支付的
        $res = $myorder->where($where)->select();
        $seat_type[0] = '软座';
        $seat_type[1] = '硬座';

        $order_status[0] = '待支付';
        $order_status[1] = '已完成';

        for ($i = 0; $i < count($res); $i++) {
            //当前座位类型
            $current_seat_type = $seat_type[$res[$i]['seat_type']];
            $res[$i]['current_seat_type'] = $current_seat_type;

            //当前订单状态
            $current_order_status = $order_status[$res[$i]['order_status']];
            $res[$i]['current_order_status'] = $current_order_status;

            //当前余额
            $res[$i]['my_money'] = session('money');

            //判断当前余额是否充足
            $is_enough = 0;//默认余额不足
            if ($res[$i]['my_money'] - $res[$i]['order_money'] >= 0) {
                $is_enough = 1;//余额充足
            }
            $res[$i]['is_enough'] = $is_enough;
        }
        $this->assign('my_orderNo', $res);

        //已成功订单显示
        $where1['realname'] = session('realname');//当前用户下的
        $where1['is_delete'] = 0;//正常票
        $where1['order_status'] = 1;//已完成的
        $res1 = $myorder->where($where1)->select();

        $seat_type1[0] = '软座';
        $seat_type1[1] = '硬座';

        $order_status1[0] = '待支付';
        $order_status1[1] = '已完成';

        for ($j = 0; $j < count($res1); $j++) {
            //当前座位类型
            $current_seat_type1 = $seat_type1[$res1[$j]['seat_type']];
            $res1[$j]['current_seat_type'] = $current_seat_type1;

            //当前订单状态
            $current_order_status1 = $order_status1[$res1[$j]['order_status']];
            $res1[$j]['current_order_status'] = $current_order_status1;

        }
        $this->assign('my_orderYes', $res1);

        $this->display();
    }

    /**
     * 跳出充值框
     */
    public function showPay()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }

        $user = M('User');
        $where['userId'] = session('userId');
        $res = $user->where($where)->find();
        $realname = $res['realname'];
        $current_my_money = session('money');

        $this->assign('realname', $realname);
        $this->assign('current_my_money', $current_my_money);

        layout(false);
        $content = $this->fetch('Business:showPayHtml');
        $this->DefaultReturn(array('content' => $content), 'success', 200);
        exit;
    }

    /**
     * 处理快速充值
     */
    public function doQPay()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }

        $request_data = I('post.');

        //快速充值也需要后台审核
        $user = M('User');
        $where['userId'] = session('userId');
        $data['pay_money'] = $request_data['qpay'];
        if (!$user->create($data)) {
            $this->DefaultReturn(0, '充值失败', 500);
            exit;
        }
        $user->where($where)->save();//将pay_money写入

        $res = $user->where($where)->find();//取出原来的金额money和待充金额pay_money（后台）
        $now_money = $res['money'] + $res['pay_money'];//求充值后的金额
        $data1['money'] = $now_money;
        if (!$user->create($data1)) {
            $this->DefaultReturn(0, '充值失败', 500);
            exit;
        }
        $user->where($where)->save();//将充值后的金额now_money写入money字段（后台）

        session('money', session('money') + $res['pay_money']);//在pay_money为0前，更新钱包session('money')(前台)

        $data2['pay_money'] = 0;
        if (!$user->create($data2)) {
            $this->DefaultReturn(0, '充值失败', 500);
            exit;
        }
        $user->where($where)->save();//将充值后的金额now_money写入money字段后，清空pay_money字段（后台）


        $this->DefaultReturn(0, '充值成功', 200);
        exit;


    }

    /**
     * 订单支付页
     */
    public function order_pay()
    {
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
        $where1['orderId'] = $request_data['orderId'];
        $res1 = $tourist->where($where1)->select();

        //座位信息获取(座位类型+座位数量)
        $seat_type[0] = '软座';
        $seat_type[1] = '硬座';

        $seat_info[0]['seat_type'] = $seat_type[$request_data['seat_type']];
        $seat_info[0]['seat_num'] = count($res1);

        //订单信息获取(订单号+订单状态)
        $my_order = M('MyOrder');
        $where2['orderId'] = $request_data['orderId'];
        $res2 = $my_order->where($where2)->select();
        $order_status[0] = '待支付';
        $order_status[1] = '已成功';

        $current_order_status = "";
        switch ($res2[0]['order_status']) {
            case 0:
                $current_order_status = $order_status[$res2[0]['order_status']];
                break;
            case 1:
                $current_order_status = $order_status[$res2[0]['order_status']];
                break;
        }
        $res2[0]['current_order_status'] = $current_order_status;

        //订单金额获取
        $order_money = $res2[0]['order_money'];

        //assign
        //车次信息assign
        $this->assign('pay_trainsInfoList', $res);
        //座位信息assign
        $this->assign('pay_seatinfoList', $seat_info);
        //乘客信息assign
        $this->assign('pay_touristList', $res1);
        //订单金额assign
        $this->assign('order_money', $order_money);
        //订单信息(订单号+订单状态) assign
        $this->assign('pay_orderList', $res2);

        $this->display();
    }

    /**
     * 支付页
     */
    public function showPayNow()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }

        $request_data = I('post.');

        //根据orderId拿到order_money
        $my_order = M('MyOrder');
        $where['orderId'] = $request_data['orderId'];
        $res = $my_order->where($where)->find();

        //当前订单号
        $this->assign('cur_orderId', $request_data['orderId']);
        //当前需支付
        $this->assign('need_money', $res['order_money']);
        //当前余额
        $this->assign('my_money', session('money'));
        //当前车次
        $this->assign('cur_train_no', $request_data['train_no']);

        layout(false);
        $content = $this->fetch('Business:showPayNowHtml');
        $this->DefaultReturn(array('content' => $content), 'success', 200);
        exit;
    }

    /**
     * 处理支付
     */
    public function doPayNow()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }

        $request_data = I('post.');

        //往trains_info表的total字段写入need_money表示本趟列车总收益
        $trainsinfo = M('TrainsInfo');
        $where['train_no'] = $request_data['cur_train_no'];
        $where['begin_date'] = session('begin_date');
        $res = $trainsinfo->where($where)->find();
        if(!$res){
            $this->DefaultReturn(0, '支付失败(系统异常),请联系管理员', 500);exit;
        }

        //更新当前订单的状态从0变为1，更新updateAt字段
        $my_order = M('MyOrder');
        $where1['orderId'] = $request_data['cur_orderId'];
        $res1 = $my_order->where($where1)->find();

        if (!$res1) {
            $this->DefaultReturn(0, '支付失败(系统异常),请联系管理员', 500);exit;
        }

        $data1['order_status'] = 1;
        $data1['updateAt'] = time();

        if (!$my_order->create($data1)) {
            $this->DefaultReturn(0, '支付失败(系统异常),请联系管理员', 500);
            exit;
        }
        $my_order->where($where1)->save();


        //座位分配,一个身份证+一个车次id（trainId）对应一个座位
        $tourist = M('Tourist');
        $where3['userId'] = session('userId');
        $where3['orderId'] = $request_data['cur_orderId'];
        $res3 = $tourist->where($where3)->select();


        $arr2 = array(
            'Date01Seat',
            'Date02Seat',
            'Date03Seat',
            'Date04Seat',
            'Date05Seat',
            'Date06Seat',
            'Date07Seat'
        );
        //获取当前日期---当前日期+7天日期
        for ($i = 0; $i < 7; $i++) {

            $this->time2[$i] = date('Y-m-d', time() + $i * 3600 * 24);
        }


        for ($j = 0; $j < 7; $j++) {
            $this->seat2[$j] = M($arr2[$j]);
        }


        for ($i = 0; $i < 7; $i++) {

            $this->seat2[$i] = M($arr2[$i]);
            $res7 = $this->seat2[$i]->select();
            if(!$res7){
                $this->DefaultReturn(0, '支付失败(座位分配异常)，请联系管理员', 500);exit;
            }

            if($res1['begin_date'] === $res7[0]['date']){
                //先查一下此订单对应的本日本车次本座位类型下的座位是否已满
                $where4['trainId'] = $res['id'];//车次id,从trains_info表中拿到
                $where4['type'] = $res1['seat_type'];//座位类型.从my_order表中拿到
                $where4['is_empty'] = 1;//为空

                $res4 = $this->seat2[$i]->where($where4)->select();

                if(!$res4){
                    $this->DefaultReturn(0, '支付失败(座位已满)，请联系管理员', 500);exit;
                }
                //空座位数一定是大于等于所提交过来的乘客数的，否则无法提交到这里来
                    for($k=0;$k<count($res4);$k++){
                        if($k === count($res3)){
                            break;
                        }

                        $where5['id'] = $res4[$k]['id'];

                        $data3['is_empty'] = 0;//座位置为不空
                        $data3['sfz'] = $res3[$k]['sfz'];//身份证

                        if(!$this->seat2[$i]->create($data3)){
                            $this->DefaultReturn(0, '支付失败(座位分配异常)，请联系管理员', 500);
                            exit;
                        }
                        $this->seat2[$i]->where($where5)->save();
                    }
            }
        }//座位分配完毕

        //还要做一件事情:将trains_info表的hard_remain和soft_remain字段更新

        //拿到订单的座位类型
        switch ($res1['seat_type']){
            case 1:
                $where7['id'] = $res['id'];

                $data4['hard_remain'] = ($res['hard_remain'] - $res1['seat_total_num']);

                if(!$trainsinfo->create($data4)){
                    $this->DefaultReturn(0, '支付异常，请联系管理员', 500);exit;
                }
                $trainsinfo->where($where7)->save();

                break;
            case 0:
                $where8['id'] = $res['id'];
                $data5['soft_remain'] = ($res['soft_remain'] - $res1['seat_total_num']);
                if(!$trainsinfo->create($data5)){
                    $this->DefaultReturn(0, '支付异常，请联系管理员', 500);exit;
                }
                $trainsinfo->where($where8)->save();
                break;
        }

        //更新user表的money字段,为当前余额-需支付,并重写session('money')
        $user = M('User');
        $where2['userId'] = session('userId');
        $res2 = $user->where($where2)->find();

        $data2['money'] = $res2['money'] - $request_data['need_money'];

        if (!$user->create($data2)) {
            $this->DefaultReturn(0, '支付失败(系统异常),请联系管理员', 500);
            exit;
        }
        $user->where($where2)->save();
        session('money', $data2['money']);


        $data['total'] = $res['total'] + $request_data['need_money'];
        if (!$trainsinfo->create($data)) {
            $this->DefaultReturn(0, '支付失败(系统异常),请联系管理员', 500);
            exit;
        }
        $trainsinfo->where($where)->save();

        $this->DefaultReturn(0, '支付成功', 200);
        exit;
    }

    /**
     * 跳出座位详情框
     */
    public function showSeatDetail()
    {

        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }

        $request_data = I('post.');


        //先拿到订单信息
        $my_order = M('MyOrder');
        $where['orderId'] = $request_data['orderId'];
        $res = $my_order->where($where)->select();

        $seat_type[0] = '软座';
        $seat_type[1] = '硬座';

        for ($i = 0; $i < count($res); $i++) {
            //当前座位类型
            $current_seat_type = $seat_type[$res[$i]['seat_type']];
            $res[$i]['current_seat_type'] = $current_seat_type;
            //座位单价
            $single_seat_price = $res[$i]['order_money'] / $res[$i]['seat_total_num'];
            $res[$i]['single_seat_price'] = $single_seat_price;
        }

        //座位分配,一个身份证+一个车次id（trainId）对应一个座位

        //拿到乘客tourist表的sfz和Id以及orderId(对应seat_date表的touristId)
        $tourist = M('Tourist');
        $where1['orderId'] = $request_data['orderId'];
        $where1['userId'] = session('userId');
//        $where1['is_display'] = 1;
        $res1 = $tourist->where($where1)->select();


        //拿到车次信息trains_info表的id(对应seat_date表的trainId)
        $trainsinfo = M('TrainsInfo');//2018.5.7 20:04 这里的车次信息应该根据订单里面的train_no和begin_date来确定，begin_date不能
        //session('begin_date')了
        $where2['train_no'] = $res[0]['train_no'];
        $where2['begin_date'] = $res[0]['begin_date'];
        $res2 = $trainsinfo->where($where2)->select();


        //当前座位类型由my_order表得到

        //$res6  seat_date表的carriage_no和seat_no字段

        $arr = array(
            'Date01Seat',
            'Date02Seat',
            'Date03Seat',
            'Date04Seat',
            'Date05Seat',
            'Date06Seat',
            'Date07Seat'
        );
        //获取当前日期---当前日期+7天日期
        for ($i = 0; $i < 7; $i++) {

            $this->time[$i] = date('Y-m-d', time() + $i * 3600 * 24);
        }


        for ($j = 0; $j < 7; $j++) {
            $this->seat[$j] = M($arr[$j]);
        }



        $res6 = array();
        for ($i = 0; $i < 7; $i++) {
            $this->seat[$i] = M($arr[$i]);
            $res3 = $this->seat[$i]->select();

            if ($res[0]['begin_date'] === $res3[0]['date']) {
                for ($j = 0; $j < count($res1); $j++) {
                    $where6['sfz'] = $res1[$j]['sfz'];
                    $where6['trainId'] = $res2[0]['id'];
                    $res6[$j] = $this->seat[$i]->where($where6)->find();
                }
            }
        }

        $assign = array();
        $seat_type1[0] = '软座';
        $seat_type1[1] = '硬座';
        $cur_seat_type = "";
        for($m=0;$m<count($res1);$m++){
           $assign[$m]['train_no'] = $res[0]['train_no'];
           $assign[$m]['fromStation'] = $res[0]['fromStation'];
           $assign[$m]['toStation'] = $res[0]['toStation'];
           $assign[$m]['begin_date'] = $res[0]['begin_date'];
           switch ($res[0]['seat_type']){
               case 1:$cur_seat_type = $seat_type1[$res[0]['seat_type']];break;
               case 0:$cur_seat_type = $seat_type1[$res[0]['seat_type']];break;
           }
           $assign[$m]['cur_seat_type'] = $cur_seat_type;
           $assign[$m]['single_seat_price'] = $res[0]['order_money'] / $res[0]['seat_total_num'];
           $assign[$m]['realname'] = $res1[$m]['realname'];
           $assign[$m]['sfz'] = $res1[$m]['sfz'];
           $assign[$m]['tel'] = $res1[$m]['tel'];
           $assign[$m]['carriage_no'] = $res6[$m]['carriage_no'];
           $assign[$m]['seat_no'] = $res6[$m]['seat_no'];
           $assign[$m]['orderId'] = $request_data['orderId'];

           //计算一下begin_date的日期值是否大于当前日期值来决定是否可以退票
            if(strtotime($res[0]['begin_date']) >= strtotime(date('Y-m-d',time()))){
                $assign[$m]['can_quit'] = 1;//可以退票
            }
            else
            {
                $assign[$m]['can_quit'] = 0;//不可以退票
            }

        }

        $this->assign('seat_tableList',$assign);

        layout(false);
        $content = $this->fetch('Business:showSeatDetailHtml');
        $this->DefaultReturn(array('content'=>$content),'success',200);exit;
    }

    /**
     * 处理订单的取消
     */
    public function doOrderCancel(){
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');exit;
        }

        $request_data = I('post.');
//        dump($request_data);die;
//        $tourist = M('Tourist');
//        $where['userId'] = session('userId');
//        $where['orderId'] = $request_data['orderId'];
//
//        $res = $tourist->where($where)->select();
//        if(!$res){
//            $this->DefaultReturn(0,'取消订单异常，请联系管理员',500);exit;
//        }
//        for($i=0;$i<count($res);$i++){
//            $where2['id'] = $res[$i]['id'];
//            $data2['trainId'] = 0;
//            $data2['orderId'] = 0;
//
//            if(!$tourist->create($data2)){
//                $this->DefaultReturn(0,'取消订单异常，请联系管理员',500);exit;
//            }
//            $tourist->where($where2)->save();
//        }

        
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
     * 退票页显示
     */
    public function OrderQuit(){
        $request_data = I('get.');
        if(empty($request_data)){
            $this->error('非法访问');exit;
        }

        //先拿到订单信息
        $my_order = M('MyOrder');
        $where['orderId'] = $request_data['orderId'];
        $res = $my_order->where($where)->select();


        $seat_type[0] = '软座';
        $seat_type[1] = '硬座';

        for ($i = 0; $i < count($res); $i++) {
            //当前座位类型
            $current_seat_type = $seat_type[$res[$i]['seat_type']];
            $res[$i]['current_seat_type'] = $current_seat_type;
            //座位单价
            $single_seat_price = $res[$i]['order_money'] / $res[$i]['seat_total_num'];
            $res[$i]['single_seat_price'] = $single_seat_price;
        }

        //座位分配,一个身份证对应一个座位

        //拿到乘客tourist表的sfz和Id以及orderId(对应seat_date表的touristId)
        $tourist = M('Tourist');
        $where1['orderId'] = $request_data['orderId'];
        $where1['userId'] = session('userId');
//        $where1['is_display'] = 1;
        $res1 = $tourist->where($where1)->select();


        //拿到车次信息trains_info表的id(对应seat_date表的trainId)
        $trainsinfo = M('TrainsInfo');
        $where2['train_no'] = $res[0]['train_no'];
        $where2['begin_date'] = $res[0]['begin_date'];
        $res2 = $trainsinfo->where($where2)->select();


        //当前座位类型由my_order表得到

        //通过trainId,current_seat_type,is_empty确定一位乘客的座位种类
        $arr3 = array(
            'Date01Seat',
            'Date02Seat',
            'Date03Seat',
            'Date04Seat',
            'Date05Seat',
            'Date06Seat',
            'Date07Seat'
        );
        //获取当前日期---当前日期+7天日期
        for ($i = 0; $i < 7; $i++) {

            $this->time3[$i] = date('Y-m-d', time() + $i * 3600 * 24);
        }


        for ($j = 0; $j < 7; $j++) {
            $this->seat3[$j] = M($arr3[$j]);
        }


        //$res6  seat_date表的carriage_no和seat_no字段
        $res6 = array();
        for ($i = 0; $i < 7; $i++) {
            $this->seat3[$i] = M($arr3[$i]);
            $res3 = $this->seat3[$i]->select();
            if ($res[0]['begin_date'] === $res3[0]['date']) {
                for ($j = 0; $j < count($res1); $j++) {
                    $where6['sfz'] = $res1[$j]['sfz'];
                    $where6['trainId'] = $res2[0]['id'];
                    $res6[$j] = $this->seat3[$i]->where($where6)->find();
                }
            }
        }

        $assign = array();
        $seat_type1[0] = '软座';
        $seat_type1[1] = '硬座';
        $cur_seat_type = "";
        for($m=0;$m<count($res1);$m++){
            $assign[$m]['train_no'] = $res[0]['train_no'];
            $assign[$m]['fromStation'] = $res[0]['fromStation'];
            $assign[$m]['toStation'] = $res[0]['toStation'];
            $assign[$m]['begin_date'] = $res[0]['begin_date'];
            switch ($res[0]['seat_type']){
                case 1:$cur_seat_type = $seat_type1[$res[0]['seat_type']];break;
                case 0:$cur_seat_type = $seat_type1[$res[0]['seat_type']];break;
            }
            $assign[$m]['cur_seat_type'] = $cur_seat_type;
            $assign[$m]['single_seat_price'] = $res[0]['order_money'] / $res[0]['seat_total_num'];
            $assign[$m]['realname'] = $res1[$m]['realname'];
            $assign[$m]['sfz'] = $res1[$m]['sfz'];
            $assign[$m]['tel'] = $res1[$m]['tel'];
            $assign[$m]['carriage_no'] = $res6[$m]['carriage_no'];
            $assign[$m]['seat_no'] = $res6[$m]['seat_no'];
            $assign[$m]['orderId'] = $request_data['orderId'];

            //计算一下begin_date的日期值是否大于当前日期值来决定是否可以退票
            if(strtotime($res[0]['begin_date']) >= strtotime(date('Y-m-d',time()))){
                $assign[$m]['can_quit'] = 1;//可以退票
            }
            else
            {
                $assign[$m]['can_quit'] = 0;//不可以退票
            }

        }

        $this->assign('seat_tableList1',$assign);

        $this->display();
    }

    /**
     * 处理退票，退票要做几件事情
     * 一张一张退票
     */
    public function doOrderQuitSingle(){
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');exit;
        }

        $request_data = I('post.');


        //确定要退票的乘客tourist,根据userId，orderId，以及传过来要退票的乘客sfz

        //先查一查我们的乘客还有几位
        $tourist = M('Tourist');
        $where['userId'] = session('userId');
        $where['orderId'] = $request_data['orderId_quit'];

        $res = $tourist->where($where)->select();

        if(!$res){
            $this->DefaultReturn(0,'退票异常，请联系管理员',500);exit;
        }


        $my_order = M('MyOrder');
        $where1['orderId'] = $request_data['orderId_quit'];
        $res1 = $my_order->where($where1)->find();
        if(!$res1){
            $this->DefaultReturn(0,'退票异常，请联系管理员',500);exit;
        }


        $trainsinfo = M('TrainsInfo');
        $where2['train_no'] = $res1['train_no'];
        $where2['begin_date'] = $res1['begin_date'];

        $res3 = $trainsinfo->where($where2)->find();
        if(!$res3){
            $this->DefaultReturn(0,'退票异常，请联系管理员',500);exit;
        }

        //单个删除的剩下最后一个的时候
        if(count($res) === 1){
            //对my_order表orderId对应的is_delete字段的更新
            $where5['orderId'] = $request_data['orderId_quit'];

            $data1['is_delete'] = 1;//此订单被删除

            if(!$my_order->create($data1)){
                $this->DefaultReturn(0,'退票异常(订单删除失败)，请联系管理员',500);exit;
            }
            $my_order->where($where5)->save();
        }

        //拿到订单信息,退票对于订单的处理：1.一个一个的退，剩下最后一个乘客的时候或者只有一个乘客的时候，
        //此时的退票会将订单的is_delete字段由0更新为1,表示此订单无效,不会在显示在“我的订单”里面
        //2.全部一次的退完所有乘客,在订单的处理上和1一样（全部都退的情况我在doOrderQuitAll方法里面去做,除了和1中的对
        //is_delete字段更新之外，对tourist表中该订单号，该用户Id下，每个sfz对应的乘客进行删除）
        //3.也是一个一个的退，还没有退完的时候，对订单my_order表的处理：对createAt字段的更新,对seat_total_num字段的更新,
        //对order_money字段的更新；对user表的money字段的更新（先收到来自系统退一张座位的钱，再扣除的这张座位10%的手续费给系统
        //所以系统只需要返还给用户该票价的90%即可,就不需要再对trains_info表的total字段的更新）,对session('money')的更新，
        //，对tourist表中该订单号，该用户Id下，该sfz的乘客进行删除
        //


        //1.在seat_type表中更新is_empty为1，清空sfz字段为null
        $arr1 = array(
            'Date01Seat',
            'Date02Seat',
            'Date03Seat',
            'Date04Seat',
            'Date05Seat',
            'Date06Seat',
            'Date07Seat'
        );


        $where6['userId'] = session('userId');
        $where6['orderId'] = $request_data['orderId_quit'];
        $where6['sfz'] = $request_data['sfz_quit'];
        $res4 = $tourist->where($where6)->find();


        //对seat_date表的更新
        for($i=0;$i<7;$i++){
            $this->seat1[$i] = M($arr1[$i]);
            $res2 = $this->seat1[$i]->select();

            if($res1['begin_date'] === $res2[0]['date']){
                $where3['sfz'] = $res4['sfz'];
                $where3['trainId'] = $res3['id'];

                $data['is_empty'] = 1;//座位置空
                $data['sfz'] = null;

                if(!$this->seat1[$i]->create($data)){
                    $this->DefaultReturn(0,'退票异常(座位清空失败)，请联系管理员',500);exit;
                }
                $this->seat1[$i]->where($where3)->save();
                break;
            }
        }






        //先对trains_info表的total字段的更新
        $where8['id'] = $res3['id'];
        $data3['total'] = $res3['total'] - $request_data['single_seat_price_quit'] * 0.9;
        if(!$trainsinfo->create($data3)){
            $this->DefaultReturn(0,'退票异常(返还退票金额失败)，请联系管理员',500);exit;
        }
        $trainsinfo->where($where8)->save();

        //对user表的money字段更新
        $user = M('User');
        $where9['userId'] = session('userId');
        $res5 = $user->where($where9)->find();
        if(!$res5){
            $this->DefaultReturn(0,'退票异常，请联系管理员',500);exit;
        }

        $data4['money'] = $res5['money'] + $request_data['single_seat_price_quit'] * 0.9;
        if(!$user->create($data4)){
            $this->DefaultReturn(0,'退票异常(接受退票金额失败)，请联系管理员',500);exit;
        }
        $user->where($where9)->save();


        //再查一次，更新session
        $where10['userId'] = session('userId');
        $res6 = $user->where($where10)->find();
        session('money',$res6['money']);


        //对my_order表updateAt,seat_total_num,order_money的更新
        $where7['orderId'] = $request_data['orderId_quit'];
        $data2['updateAt'] = time();
        $data2['seat_total_num'] = $res1['seat_total_num'] - 1;
        $data2['order_money'] = $res1['order_money'] - $request_data['single_seat_price_quit'];

        if(!$my_order->create($data2)){
            $this->DefaultReturn(0,'退票异常(订单修改失败)，请联系管理员',500);exit;
        }
        $my_order->where($where7)->save();


        //对tourist表userId,sfz,orderId对应的记录删除
        $where4['sfz'] = $request_data['sfz_quit'];
        $where4['orderId'] = $request_data['orderId_quit'];
        $where4['userId'] = session('userId');

        // dump($where4);die;
//        $data5['is_delete'] = 1;
        $data5['trainId'] = 0;
        $data5['orderId'] = 0;

        if(!$tourist->create($data5)){
            $this->DefaultReturn(0,'退票异常(乘客购票权限再开放失败)，请联系管理员',500);exit;
        }
        $tourist->where($where4)->save();
        $this->DefaultReturn(0,'退票成功。',200);exit;
    }
    /**
     * 乘客录入
     */
    public function touristAdd(){
        $where['userId'] = session('userId');
        $where['is_delete'] = 0;

        $tourist = M('Tourist');
        $res = $tourist->where($where)->select();
        $this->assign('touristList',$res);
        $this->display();
    }

    /**
     * 乘客新增框弹出
     */
    public function showTouristAdd()
    {
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }
        //根据session('userId')拿一下realname
        $user = M('User');
        $where['userId'] = session('userId');
        $res = $user->where($where)->field('realname')->find();

        layout(false);
        $myself = $res['realname'];
        $content = $this->fetch('Business:showTouristAddHtml');
        $this->DefaultReturn(array('content' => $content, 'myself' => $myself), 'success', 200);
        exit;
    }
    /**
     * 处理乘客的增加
     */
    public function doTouristAdd(){
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }
        $request_data = I('post.');

        $tourist = M('Tourist');

        $where['userId'] = session('userId');
        $where['sfz'] = $request_data['sfz'];

        $res = $tourist->where($where)->find();
        if(!$res){//没有乘客则add
            $data['userId'] = session('userId');
            $data['sfz'] = $request_data['sfz'];
            $data['realname'] = $request_data['realname'];
            $data['tel'] = $request_data['tel'];
            if(!$tourist->create($data)){
                $this->DefaultReturn(0,'新增异常',500);exit;
            }
            $tourist->add();
            $this->DefaultReturn(0,'新增成功',200);exit;
        }
        else if($res && 0 == $res['is_delete']){
            $this->DefaultReturn(0,'新增失败(该乘客已存在)',500);exit;
        }
        else if($res && 1 == $res['is_delete'] && 0 == $res['trainId'] && 0 == $res['orderId']){
            $where['id'] = $res['id'];
            $data['is_delete'] = 0;
            if(!$tourist->create($data)){
                $this->DefaultReturn(0,'新增异常',500);exit;
            }
            $tourist->where($where)->save();
            $this->DefaultReturn(0,'新增成功',200);exit;
        }
        else if($res && 1 == $res['is_delete'] && 0 != $res['trainId'] && 0 != $res['orderId']){
            $where['id'] = $res['id'];
            $data1['is_delete'] = 0;
            if(!$tourist->create($data1)){
                $this->DefaultReturn(0,'新增异常',500);exit;
            }
            $tourist->where($where)->save();
            $this->DefaultReturn(0,'新增成功',200);exit;
        }
    }
    /**
     * 处理乘客的删除
     */
    public function doTouristDel(){
        if (!IS_POST || !IS_AJAX) {
            $this->error('非法访问');
            exit;
        }
        $request_data = I('post.');

        $tourist = M('Tourist');
        $where['id'] = $request_data['tourist_id'];
        $data['is_delete'] = 1;
        if(!$tourist->create($data)){
            $this->DefaultReturn(0,'删除异常',500);exit;
        }
        $tourist->where($where)->save();
        $this->DefaultReturn(0,'删除成功',200);exit;
    }
}