<?php if (!defined('THINK_PATH')) exit();?><style>
    .detail{text-align: center}
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
        <th>车次</th>
        <th>起始站</th>
        <th>终到站</th>
        <th>发车时间</th>
        <th>硬座总数</th>
        <th>硬座剩余</th>
        <th>硬座票价</th>
        <th>软座总数</th>
        <th>软座剩余</th>
        <th>软座票价</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($detailList)): foreach($detailList as $key=>$pv): ?><tr>
            <td class="detail"><?php echo ($pv["train_no"]); ?></td>
            <td class="detail"><?php echo ($pv["fromStation"]); ?></td>
            <td class="detail"><?php echo ($pv["toStation"]); ?></td>
            <td class="detail"><?php echo ($pv["begin_date"]); ?></td>
            <td class="detail"><?php echo ($pv["hard_total_num"]); ?></td>
            <td class="detail"><span class="red"><?php echo ($pv["hard_remain"]); ?></span></td>
            <td class="detail"><span class="red"><?php echo ($pv["hard_price"]); ?>元</span></td>
            <td class="detail"><?php echo ($pv["soft_total_num"]); ?></td>
            <td class="detail"><span class="red"><?php echo ($pv["soft_remain"]); ?></span></td>
            <td class="detail"><span class="red"><?php echo ($pv["soft_price"]); ?>元</span></td>
        </tr><?php endforeach; endif; ?>
    </tbody>
</table>