<?php
/**
 * Created by PhpStorm.
 * User: weiyikai
 * Date: 2018/5/10
 * Time: 9:23
 */
namespace Admin\Controller;

use Think\Controller;

class BusinessController extends RootController {
    private $time1;
    private $seat1;
    /**
     * 车次管理
     */
    public function trainsManage(){
        //显示seat_total表列车信息
        $st = M('SeatTotal');
        $where['is_delete'] = 0;//未被删除的
        $res = $st->where($where)->select();
        $this->assign('trainsList',$res);
        $this->display();
    }
    /**
     * 显示列车车次添加
     */
    public function showTrainsAdd(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }


        layout(false);
        $content = $this->fetch('Business:showTrainsAddHtml');
        $this->DefaultReturn(array('content' => $content), 'success', 200);
        exit;
    }
    /**
     * 处理列车车次的添加
     */
    public function doTrainsAdd(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }

        $request_data = I('post.');


        $st = M('SeatTotal');
        $data['train_no'] = $request_data['train_no'];
        $data['fromStation'] = $request_data['fromStation'];
        $data['toStation'] = $request_data['toStation'];
        $data['viaStation'] = $request_data['viaStation'];
        $data['hard_carriage_num'] = $request_data['hard_carriage_num'];
        $data['hard_seat_num'] = $request_data['hard_seat_num'];
        $data['hard_price'] = $request_data['hard_price'];
        $data['soft_carriage_num'] = $request_data['soft_carriage_num'];
        $data['soft_seat_num'] = $request_data['soft_seat_num'];
        $data['soft_price'] = $request_data['soft_price'];


        //车次检验

        $where['train_no'] = $request_data['train_no'];

        $res = $st->where($where)->find();


        if($res && 0 == $res['is_delete']){
            $this->DefaultReturn(0,'新增异常(此车次已存在)',500);exit;
        }

        if($res && 1 == $res['is_delete']){

            $where1['id'] = $res['id'];
            $data2['is_delete'] = 0;
            if(!$st->create($data2)){
                $this->DefaultReturn(0,'新增异常',500);exit;
            }
            $st->where($where1)->save();
            $this->DefaultReturn(0,'新增成功',200);exit;
        }
        if(!$res){
            //完全不存在时add一条
            if(!$st->create($data)){
                $this->DefaultReturn(0,'新增异常',500);exit;
            }
            $st->add();
        }
        $this->DefaultReturn(0,'新增成功',200);exit;
    }
    /**
     * 处理车次的删除
     */
    public function doTrainsDel(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }

        $request_data = I('post.');

        $st = M('SeatTotal');
        $where['id'] = $request_data['tid'];
        $data['is_delete'] = 1;
        if(!$st->create($data)){
            $this->DefaultReturn(0,'删除失败',500);exit;
        }
        $st->where($where)->save();
        $this->DefaultReturn(0,'删除成功',200);exit;
    }
    /**
     * 车次信息管理
     */
    public function trainsInfoManage(){
        $st = M('SeatTotal');
        $where1['is_delete'] = 0;
        $res1 = $st->where($where1)->select();


        $arr1 = array(
            'Date01Seat',
            'Date02Seat',
            'Date03Seat',
            'Date04Seat',
            'Date05Seat',
            'Date06Seat',
            'Date07Seat'
        );

        $trainsInfo = M('TrainsInfo');


        for($i=0;$i<count($res1);$i++){
            //向trainsinfo表写入本车次当前日期-----当前日期+7的车次信息
            $trainsInfo = M('TrainsInfo');
            $where2['train_no'] = $res1[$i]['train_no'];
            $where2['is_delete'] = 0;
            $res2 = $trainsInfo->where($where2)->select();

            if($res2){//存在此车次信息


                    for($j=0;$j<7;$j++){
                        $this->time1[$j] = date('Y-m-d',time()+$j*3600*24);
                        $data2['train_no'] = $res1[$i]['train_no'];
                        $data2['fromStation'] = $res1[$i]['fromStation'];
                        $data2['toStation'] = $res1[$i]['toStation'];
                        $data2['viaStation'] = $res1[$i]['viaStation'];
                        $data2['begin_date'] = $this->time1[$j];
                        $data2['hard_total_num'] = $res1[$i]['hard_carriage_num']*$res1[$i]['hard_seat_num'];
                        $data2['soft_total_num'] = $res1[$i]['soft_carriage_num']*$res1[$i]['soft_seat_num'];
                        $data2['hard_price'] = $res1[$i]['hard_price'];
                        $data2['soft_price'] = $res1[$i]['soft_price'];
                        $where3['id'] = $res2[$j]['id'];
                        if(!$trainsInfo->create($data2)){
                            $this->error('非法访问');exit;
                        }
                        $trainsInfo->where($where3)->save();
                    }
            }
            else{
                //获取当前日期---当前日期+7天日期
                for($j=0;$j<7;$j++){
                    $this->time1[$j] = date('Y-m-d',time()+$j*3600*24);
                    $data1['train_no'] = $res1[$i]['train_no'];
                    $data1['fromStation'] = $res1[$i]['fromStation'];
                    $data1['toStation'] = $res1[$i]['toStation'];
                    $data1['viaStation'] = $res1[$i]['viaStation'];
                    $data1['begin_date'] = $this->time1[$j];
                    $data1['hard_total_num'] = $res1[$i]['hard_carriage_num']*$res1[$i]['hard_seat_num'];
                    $data1['soft_total_num'] = $res1[$i]['soft_carriage_num']*$res1[$i]['soft_seat_num'];
                    $data1['hard_price'] = $res1[$i]['hard_price'];
                    $data1['soft_price'] = $res1[$i]['soft_price'];
                    if(!$trainsInfo->create($data1)){
                        $this->error('非法访问');exit;
                    }
                    $trainsInfo->add();
                }
            }
        }

            //先看看本车次的座位分布情况是否已经存在，若已经存在则无需add操作
            for($q=0;$q<7;$q++){
                $this->seat1[$q] = M($arr1[$q]);

                $res4 = $this->seat1[$q]->select();
                dump($res4);
                die;
                if(!$res4){
                    $this->error('请配置车次信息');exit;
                }

                //向seat_date表写入seat_total表的座位分配情况和trainsInfo表的train_no
                for($p=0;$p<count($res1);$p++){
                $where5['begin_date'] = $res4[0]['date'];
                $where5['train_no'] = $res1[$p]['train_no'];

                $res5 = $trainsInfo->where($where5)->find();


                $where4['train_no'] = $res1[$p]['train_no'];
                $res3 = $this->seat1[$q]->where($where4)->select();

                if(!$res3){//若不存在则add

                    $hard_carriage_num = $res1[$p]['hard_carriage_num'];
                    $hard_seat_num = $res1[$p]['hard_seat_num'];


                    $soft_carriage_num = $res1[$p]['soft_carriage_num'];
                    $soft_seat_num = $res1[$p]['soft_seat_num'];

                    //硬座
                    for($h1=1;$h1<=$hard_carriage_num;$h1++){
                        for($h2=1;$h2<=$hard_seat_num;$h2++){
                            $data3['carriage_no'] = $h1;
                            $data3['seat_no'] = $h2;
                            $data3['type'] = 1;
                            $data3['is_empty'] = 1;
                            $data3['trainId'] = $res5['id'];
                            $data3['date'] = $res4[0]['date'];
                            $data3['train_no'] = $res1[$p]['train_no'];

                            if(!$this->seat1[$q]->create($data3)){
                                $this->error('非法访问');exit;
                            }
                            $this->seat1[$q]->add();
                        }
                    }

                    //软座
                    for($s1=1;$s1<=$soft_carriage_num;$s1++){
                        for($s2=1;$s2<=$soft_seat_num;$s2++){
                            $data3['carriage_no'] = $s1;
                            $data3['seat_no'] = $s2;
                            $data3['type'] = 0;
                            $data3['is_empty'] = 1;
                            $data3['trainId'] = $res5['id'];
                            $data3['date'] = $res4[0]['date'];
                            $data3['train_no'] = $res1[$p]['train_no'];

                            if(!$this->seat1[$q]->create($data3)){
                                $this->error('非法访问');exit;
                            }
                            $this->seat1[$q]->add();
                        }
                    }

                }else {//存在则更新trainId
                    $where6['train_no'] = $res1[$p]['train_no'];
                    $where6['date'] = $res3[0]['date'];

                    $res6 = $this->seat1[$q]->where($where6)->select();

                    for ($m = 0; $m < count($res6); $m++) {
                        $where7['id'] = $res6[$m]['id'];

                        $data4['trainId'] = $res5['id'];
                        if (!$this->seat1[$q]->create($data4)) {
                            $this->error('非法访问');
                            exit;
                        }
                        $this->seat1[$q]->where($where7)->save();
                    }
                }
                }
        }








        $where['is_delete'] = 0;
        $res = $trainsInfo->where($where)->select();

        $this->assign('trainsInfoList',$res);
        $this->display();
    }
    /**
     * 显示车次信息增加页面
     */
    public function showTrainsInfoAdd(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }
        layout(false);
        $content = $this->fetch('Business:showTrainsInfoAddHtml');
        $this->DefaultReturn(array('content' => $content), 'success', 200);
        exit;
    }
    /**
     * 处理车次信息增加
     */
    public function doTrainsInfoAdd(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }
        $request_data = I('post.');

        //先根据$request_data['train_no']去seat_total表中看看有没有该车次
        $st = M('SeatTotal');
        $where['train_no'] = $request_data['train_no'];
        $where['is_delete'] = 0;
        $res = $st->where($where)->find();

        if(!$res){
            $this->DefaultReturn(0,'新增失败(该车次不存在)',500);exit;
        }



        if(strtotime($request_data['begin_date']) > (time()+6*3600*24)){
            $this->DefaultReturn(0,'新增失败(当前时间应为今日起6天内的日期)',500);exit;
        }

        //再向trainsInfo表add
        $trainsInfo = M('TrainsInfo');
        $data['train_no'] = $request_data['train_no'];
        $data['fromStation'] = $request_data['fromStation'];
        $data['toStation'] = $request_data['toStation'];
        $data['begin_date'] = $request_data['begin_date'];
        $data['viaStation'] = $request_data['viaStation'];
        $data['hard_price'] = $request_data['hard_price'];
        $data['soft_price'] = $request_data['soft_price'];
        if(!$trainsInfo->create($data)){
            $this->DefaultReturn(0,'新增失败',500);exit;
        }
        $trainsInfo->add();
        $this->DefaultReturn(0,'新增成功',200);exit;
    }
    /**
     * 处理车次信息De删除
     */
    public function doTrainsInfoDel(){
        if(!IS_POST||!IS_AJAX){
            $this->error('非法访问');exit;
        }
        $request_data = I('post.');
        dump($request_data);die;
        $trainsInfo = M('TrainsInfo');
        $where['id'] = $request_data['tid'];
        $data['is_delete'] = 1;
        if(!$trainsInfo->create($data)){
            $this->DefaultReturn(0,'删除失败',500);exit;
        }
        $trainsInfo->where($where)->save();
        $this->DefaultReturn(0,'删除成功',200);exit;
    }
}