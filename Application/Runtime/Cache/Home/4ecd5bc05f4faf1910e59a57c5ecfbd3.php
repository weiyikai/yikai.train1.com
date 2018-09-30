<?php if (!defined('THINK_PATH')) exit();?><style>
    .detail{text-align: center;color: red;}
</style>
<table class="layui-table" lay-even="" lay-skin="row">
    <!--<colgroup>-->
    <!--<col width="150">-->
    <!--<col width="200">-->
    <!--<col width="200">-->
    <!--<col width="150">-->
    <!--</colgroup>-->
    <thead>
    <tr>
        <th>订单号</th>
        <th>车次</th>
        <th>起始站</th>
        <th>终到站</th>
        <th>发车时间</th>
        <th>座位类型</th>
        <th>座位单价</th>
        <th>车厢号</th>
        <th>座位号</th>
        <th>乘客</th>
        <th>身份证</th>
        <th>联系方式</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($seat_tableList)): foreach($seat_tableList as $key=>$pv): ?><tr>
            <td class="detail orderId_quit"><?php echo ($pv["orderId"]); ?></td>
            <td class="detail"><?php echo ($pv["train_no"]); ?></td>
            <td class="detail"><?php echo ($pv["fromStation"]); ?></td>
            <td class="detail"><?php echo ($pv["toStation"]); ?></td>
            <td class="detail"><?php echo ($pv["begin_date"]); ?></td>
            <td class="detail"><?php echo ($pv["cur_seat_type"]); ?></td>
            <td class="detail single_seat_price"><?php echo ($pv["single_seat_price"]); ?>元</td>
            <td class="detail"><?php echo ($pv["carriage_no"]); ?></td>
            <td class="detail"><?php echo ($pv["seat_no"]); ?></td>
            <td class="detail"><?php echo ($pv["realname"]); ?></td>
            <td class="detail"><?php echo ($pv["sfz"]); ?></td>
            <td class="detail"><?php echo ($pv["tel"]); ?></td>
        </tr><?php endforeach; endif; ?>
    </tbody>
</table>

<script>

</script>