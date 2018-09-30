<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends RootController {

    private $time1;
    private $time2;
    private $seat1;
    private $seat2;


    private $test;
    /**
     * 首页
     */
    public function index(){
        //每当访问首页时，写入当前日期---当前日期+7天的座位表(这是后台要做的事情，不过现在要用到没办法了)

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
        for($i=0;$i<7;$i++){

           $this->time1[$i] = date('Y-m-d',time()+$i*3600*24);
        }

        for($i=0;$i<7;$i++){

            $this->test[$i] = date('Y-m-d',time()+$i*3600*24 - 10*3600*24);
        }




        //写入日期(一个日期对应一张座位表，00.00以后见分晓)


        ////当前日期-------当前日期+7的日期哦
//        for($k=0;$k<7;$k++) {
//            $this->seat1[$k] = M($arr[$k]);
//            $res = $this->seat1[$k]->select();
//            for($j=0;$j<count($res);$j++){
//                //写入date字段
//                //$data['is_empty'] = 1;
//                //$data['sfz'] = null;
//                $data['date'] = $this->time1[$k];
//                $where['id'] = $res[$j]['id'];
//                if($this->seat1[$k]->create($data)){
//                    $this->seat1[$k]->where($where)->save();
//                }
//            }
//        }

        //用于测试,让规定的7天预约日期全部小于当前日期，然后测试首次访问Index控制器下的index方法的时train_date0x_seat中日期的判断。
//        for($k=0;$k<7;$k++) {
//            $this->seat1[$k] = M($arr[$k]);
//            $res = $this->seat1[$k]->select();
//            for($j=0;$j<count($res);$j++){
//                //写入date字段
//                //$data['is_empty'] = 1;
//                //$data['sfz'] = null;
//                $data['date'] = $this->test[$k];
//                $where['id'] = $res[$j]['id'];
//                if($this->seat1[$k]->create($data)){
//                    $this->seat1[$k]->where($where)->save();
//                }
//            }
//        }
//        dump(456);
//        die;



        $count = 0;//记录小于当前日期的日期数量（$count为1是为正常情况,大于1表示系统长时间没有使用，当前日期已经大于了规定7天中最大的日期，此时就
        //需要重新载入当前日期--->当前日期+7天的日期到train_date0x_seat,(x>=0 $$ x<=7)）
        for($i=0;$i<7;$i++){
            $this->seat1[$i] = M($arr[$i]);

            $res = $this->seat1[$i]->select();

            if(strtotime($res[0]['date']) < strtotime(date('Y-m-d',time()))){
                $count++;
            }
        }

        if($count > 1){
            //写入日期(一个日期对应一张座位表，00.00以后见分晓)


            ////当前日期-------当前日期+7的日期哦
            for($k=0;$k<7;$k++) {
                $this->seat1[$k] = M($arr[$k]);
                $res = $this->seat1[$k]->select();
                for($j=0;$j<count($res);$j++){
                    //写入date字段
                    //$data['is_empty'] = 1;
                    //$data['sfz'] = null;
                    $data['date'] = $this->time1[$k];
                    $where['id'] = $res[$j]['id'];
                    if($this->seat1[$k]->create($data)){
                        $this->seat1[$k]->where($where)->save();
                    }
                }
            }
        }


        for($i=0;$i<7;$i++){
            $this->seat1[$i] = M($arr[$i]);

            $res = $this->seat1[$i]->select();

            if(strtotime($res[0]['date']) < strtotime(date('Y-m-d',time()))){
                //比当前日期小的日期的date,is_empty,sfz字段的更新
                for($j=0;$j<count($res);$j++){

                    $data['date'] = date('Y-m-d',(strtotime($res[0]['date']) + 7*3600*24 ));
                    $data['is_empty'] = 1;
                    $data['sfz'] = null;

                    $where['date'] = $res[0]['date'];
                    if(!$this->seat1[$i]->create($data)){
                        $this->error('非法访问');exit;
                    }
                    $this->seat1[$i]->where($where)->save();


                    //情况$res[$j]['date']对应下车次的乘客订单信息
                    $where1['begin_date'] = $res[$j]['date'];
                    $trainsInfo = M('TrainsInfo');
                    $res1 = $trainsInfo->where($where1)->select();

                    if($res1){
                        for($k=0;$k<count($res1);$k++){
                            $where2['trainId'] = $res1[$k]['id'];

//                            $where4['id'] = $res1[$k]['id'];
//                            $data1['hard_remain'] = $res1[$k]['hard_total_num'];
//                            $data1['soft_remain'] = $res1[$k]['soft_total_num'];
//                            if(!$trainsInfo->create($data1)){
//                                $this->error('非法访问');exit;
//                            }
//                            $trainsInfo->where($where4)->save();
                            $tourist = M('Tourist');
                            $res2 = $tourist->where($where2)->select();
                            if($res2){
                                for($m=0;$m<count($res2);$m++){
                                    $where3['id'] = $res2[$m]['id'];

                                    $data['trainId'] = 0;
                                    $data['orderId'] = 0;
                                    if(!$tourist->create($data)){
                                        $this->error('非法访问');exit;
                                    }
                                    $tourist->where($where3)->save();
                                }
                            }
                        }
                    }

                }
            }
        }


        $this->display();
    }

    /**
     * 车次查询列表
     */
    public function serachList(){

        $where = array(
            'fromStation'=>session('fromStation'),
            'toStation'=>session('toStation'),
            'begin_date'=>session('begin_date')
        );
        $trainsinfo = M('TrainsInfo');
        $res = $trainsinfo->where($where)->select();

        //（后台）票价固定，由后台管理员写入,（前台）前台只负责取出来就行



        //剩余票数 = 总票数-售出票数
        //总票数将由train_seat_total表计算得出，然
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
        for($i=0;$i<7;$i++){

            $this->time2[$i] = date('Y-m-d',time()+$i*3600*24);
        }


        for($j=0;$j<7;$j++){
            $this->seat2[$j] = M($arr2[$j]);
        }

//        //必须传入一个车次进来
//        session(session('fromStation').'to'.session('toStation'),array(0=>'D5012',1=>'K8168',2=>'Z560'));
//        $session_train_no = session(session('fromStation').'to'.session('toStation'));


        //根据日期和车次号train_no拿到seat表要用的trainId值2018.04.24 4:08
        //（后台）而后台则根据添加的发车时间和车次去trainsinfo表中拿到seat的trainId值并且写入trainId字段以供前台进行查询
        $index = array(
            'fromStation'=>session('fromStation'),
            'toStation'=>session('toStation'),
            'begin_date'=>session('begin_date')
        );
        $res3 = $trainsinfo->where($index)->select();//从trains_info表中拿到seat表要用的trainId


        $stn = M('SeatTotal');
//        //当前日期---当前日期+7天日期所有车次剩余的软硬座数量情况
        for($q=0;$q<7;$q++){
            $this->seat2[$q] = M($arr2[$q]);
            $res1 = $this->seat2[$q]->select();

            if($res1[0]['date'] === session('begin_date')){
                //当日所有车次剩余的软硬座数量情况
                for($p=0;$p<count($res3);$p++){


                    //当日所有车次对应的软硬座总票数
                    $seat_total['train_no'] = $res3[$p]['train_no'];
                    $ss = $stn->where($seat_total)->find();


                    //当前车次的(软)硬座总数 = (软)硬座车厢数 * 每节(软)硬座车厢的座位数
                    $hard_total_num = $ss['hard_carriage_num'] * $ss['hard_seat_num'];
                    $soft_total_num = $ss['soft_carriage_num'] * $ss['soft_seat_num'];


                    //硬座售出票数
                    $hard_out['trainId'] = $res3[$p]['id'];
                    $hard_out['date'] = session('begin_date');
                    $hard_out['is_empty'] = 0;//座位不为空
                    $hard_out['type'] = 1;//硬座

                    $hard_out_count = count($this->seat2[$q]->where($hard_out)->select());


                    $hard_remain_count = $hard_total_num - $hard_out_count;//硬座剩余票数 = 总票数-售出票数

                    $data1['hard_total_num'] = $hard_total_num;
                    $data1['hard_remain'] = $hard_remain_count;
                    $save1['id'] = $res[$p]['id'];
                    if($trainsinfo->create($data1)){
                        $trainsinfo->where($save1)->save();
                    }

                    //软座售出票数
                    $soft_out['trainId'] = $res3[$p]['id'];
                    $soft_out['date'] = session('begin_date');
                    $soft_out['is_empty'] = 0;//座位不为空
                    $soft_out['type'] = 0;//软座

                    $soft_out_count = count($this->seat2[$q]->where($soft_out)->select());
                    $soft_remain_count = $soft_total_num - $soft_out_count;//硬座剩余票数 = 总票数-售出票数

                    $data2['soft_total_num'] = $soft_total_num;
                    $data2['soft_remain'] = $soft_remain_count;
                    $save2['id'] = $res[$p]['id'];
                    if($trainsinfo->create($data2)){
                        $trainsinfo->where($save2)->save();
                    }
                }
            }
        }


        /*废除此想法
        //访问此方法时，剩余硬座（软座）为trains_info表的hard_remain和soft_remain字段的值
        $stn = M('SeatTotal');
        for($p=0;$p<count($res3);$p++){
            //当日所有车次对应的软硬座总票数
            $seat_total['train_no'] = $res3[$p]['train_no'];
            $ss = $stn->where($seat_total)->find();

            //当前车次的(软)硬座总数 = (软)硬座车厢数 * 每节(软)硬座车厢的座位数
            $hard_total_num = $ss['hard_carriage_num'] * $ss['hard_seat_num'];
            $soft_total_num = $ss['soft_carriage_num'] * $ss['soft_seat_num'];

            $data1['hard_total_num'] = $hard_total_num;
            $data1['soft_total_num'] = $soft_total_num;
            $save1['id'] = $res[$p]['id'];
            if($trainsinfo->create($data1)){
                $trainsinfo->where($save1)->save();
            }

        }
        */


        //再取一次
        $assign = $trainsinfo->where($where)->select();

        //剩余座位总和
        for($n=0;$n<count($assign);$n++){
            $total_remain = $assign[$n]['hard_remain'] + $assign[$n]['soft_remain'];
            $assign[$n]['total_remain'] = $total_remain;
        }


        $this->assign('trainsList',$assign);


        $this->display();
    }

    /**
     * 车次详情显示
     */
    public function detailDisplay(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }
        $requset_data = I('post.');

        //获取票价

        $trainsinfo = M('TrainsInfo');
        $where = array(
            'train_no'=>$requset_data['train_no'],
            'fromStation'=>session('fromStation'),
            'toStation'=>session('toStation'),
            'begin_date'=>session('begin_date')
        );
        $res = $trainsinfo->where($where)->select();

        //获取车次详情信息列表
        $this->assign('detailList',$res);
        layout(false);
        $content = $this->fetch('Index:detailListHtml');

        //echo $content;die;
        $this->DefaultReturn(array('content'=>$content),'success',200);exit;

       // $this->DefaultReturn(0,'哈哈',200);
        //2018.04.26 03.06
    }

    /**
     * 查询处理
     */
    public function doSerach(){
        if(!IS_POST || !IS_AJAX){
            $this->error('非法访问');exit;
        }
        $request_data = I('post.');

        if(empty($request_data)){
            $this->DefaultReturn(0,'系统未检测到有数据提交',500);exit;
        }

        $session = array(
            'fromStation'=>$request_data['fromStation'],
            'toStation'=>$request_data['toStation'],
            'begin_date'=>$request_data['begin_date'],
        );
        $this->setSessionInfo($session);


//        //剩余车票数 = 总票数-已售票数
//
//        $where = array(
//            'fromStation'=>session('fromStation'),
//            'toStation'=>session('toStation'),
//            'begin_date'=>session('begin_date')
//        );
//
//
//        $trainsinfo = M('TrainsInfo');
//
//        $res = $trainsinfo->where($where)->field('id')->select();//从trains_info表中拿到seat表的trainId
//        //dump($res);die;
//        $hard['trainId'] = $res[0]['id'];
//        $hard['date'] = session('begin_date');
//        $hard['is_empty'] = 0;
//
//        //dump(IndexController::$seat[0]);die;
//
//        $s = M('data')
//
//        $hard_out_count = count(->where($hard)->select());
//
//        $hard_remain_count = session('hard_total_num')  - $hard_out_count;//剩余票数 = 总票数-售出票数
//
//
//        $data['hard_remain'] = $hard_remain_count;
//        $where2['id'] = $res[0]['id'];
//        if($trainsinfo->create($data)){
//            $trainsinfo->where($where2)->save();
//        }

        $this->DefaultReturn(U('Index/serachList'),'',200);
    }

    /**
     * 提示信息
     * @param string $message
     * @param bool $correct
     */
    public function returnMessage($message = '出错', $correct = false){
        send_http_status(200);
        die($message);
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
     * 赋值SESSION
     * @param array $data
     * @return bool
     */
    public function setSessionInfo($data = array()){
        if(empty($data)) return false;
        session('fromStation',$data['fromStation']);
        session('toStation',$data['toStation']);
        session('begin_date',$data['begin_date']);
        session('hard_total_num',$data['hard_total_num']);
        session('soft_total_num',$data['soft_total_num']);
    }
}