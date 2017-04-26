<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"E:\WAPM\WWW\chenyan\11\fruits\fruits\public/../application/home\view\cart\unpaid.html";i:1493210308;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>订单中心</title>
    <base href="__PUBLIC__">
    <link rel="stylesheet" type="text/css" href="car/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="car/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="car/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="car/css/style.css"/>
    <script src="car/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
</head>
<!--loading页开始-->
<div class="loading">
    <div class="loader">
        <div class="loader-inner pacman">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<!--loading页结束-->
<body>
<header class="top-header fixed-header">
    <a class="icona" href="javascript:history.go(-1)">
        <img src="car/images/left.png"/>
    </a>
    <h3>全部订单</h3>
    <font color="red"> <a href="<?php echo url('index.php/home/Cart/orderinfo'); ?>">已付款</a></font>
    <a href="<?php echo url('index.php/home/Cart/unpaid'); ?>"> 我的未付款</a>
    <a class="iconb" href="shopcar.html">

    </a>
</header>

<a href=""></a>
<div class="contaniner fixed-conta">
    <?php if($num == 0): else: ?>

    <section class="order">
        <?php foreach ($data as $k=>$va) {?>

        <!--付款-->
        <dl class="n<?php echo $va['o_id']; ?>">
            <dt>
                <time><?php echo $va['o_time']; ?></time>
                <?php if($va['o_state'] == 1): ?>
                <span>待发货</span>
                <?php elseif($va['o_state'] == 2): ?>
                <span>已发货</span>
                <?php elseif($va['o_state'] == 3): ?>
                <span  class="huo">已送到</span>
                <?php elseif($va['o_state'] == 4): ?>
                <span>已确认收货</span>
                <?php elseif($va['o_state'] == 0): ?>
                <span>待付款</span>
                <?php endif; ?>

            </dt>
            <?php foreach ($list[$k] as $ke=>$ve) {?>

            <ul >
                <a href="detail.html">
                    <figure><img src="<?php echo $ve['f_img']; ?>"/></figure>
                    <li>
                        <p><?php echo $ve['f_name']; ?>:<?php echo $ve['f_title']; ?></p>
                        <small>规格:<?php echo $ve['f_weight']; ?></small>
                        <strong>×<?php echo $num[$k][$ke]?></strong>

                    </li>
                </a>
            </ul>
            <?php }?>
            <dd >
                <h3>商品总额</h3>
                <i>￥<?php echo $va['all_price']; ?>.00</i>
            </dd>
            <dd >
                <?php if($va['o_state'] == 1): ?>
                <input type="button" value="查看物流"  class="wu"  alt="<?php echo $va['o_id']; ?>"/>

                <?php elseif($va['o_state'] == 2): ?>
                <input type="button" value="查看物流"  class="wu"  alt="<?php echo $va['o_id']; ?>"/>

                <?php elseif($va['o_state'] == 3): ?>
                <input type="button" value="查看物流"  class="wu"  alt="<?php echo $va['o_id']; ?>"/>
                <a href="javascript:void(0)" class="n<?php echo $va['o_id']; ?>"> <input type="button" value="确认收货" class="order"  alt="<?php echo $va['o_id']; ?>" style="background-color: red;width: 90px;height: 30px;"/></a>

                <?php elseif($va['o_state'] == 4): ?>
                <!--<input type="button" value="确认收货" class="order-que"/>-->
                <input type="button" value="查看物流"  class="wu"  alt="<?php echo $va['o_id']; ?>"/>
                <?php elseif($va['o_state'] == 0): if(($va['o_address'] == '')  AND ($address == 0)): ?>
                <a href="<?php echo url('index.php/home/Userinfo/address'); ?>">没有收货地址，请点我去添加,也可以修改默认地址</a>
                <?php elseif($address != 0): ?>
                <input type="hidden" class="address" value="<?php echo $address; ?>">
                <a href="<?php echo url('index.php/home/Userinfo/address'); ?>">没有收货地址，请点我去添加,<br>否则自动选择默认地址</a>
                <?php endif; ?>
                <input type="button" value="我要付款"  class="fu"  alt="<?php echo $va['o_id']; ?>" style="background-color: red;width: 90px;height: 30px;"/>

                <?php endif; ?>
                <!--<input type="button" value="确认收货" class="order-que"/>-->
                <!--<input type="button" value="查看物流"  class="wu"  alt="<?php echo $va['o_id']; ?>"/>-->
                <!--<input type="button" value="取消订单" />-->
            </dd>

        </dl>




        <?php }?>


    </section>
    <?php endif; ?>

</div>
</body>
</html>
<script src="js/jq.js"></script>
<script>
    //我要付款
    $('.fu').click(function(){
        //修改订单状态为收货状态
        var oid=$(this).attr('alt');
        var address=$('.address').val();
        var str='';
        var _this=$('this');
        $.ajax({
            type: "POST",
            url: "<?php echo url('index.php/home/Cart/payment'); ?>",
            data: "o_id="+oid+"&address="+address,
            dataType:'json',
            success: function(msg){
//                alert(msg);
                if(msg.az==2){
                    alert('付款成功');
                    $('.n'+oid).hide();
//                    $('.huo').html('已确认收货');
                }
                if(msg.az==1){
                    alert('付款失败');
                }
            }
        });
    })
    //    确认收货
    $('.order').click(function(){
        //修改订单状态为收货状态
        var oid=$(this).attr('alt');
        var str='';
        var _this=$('this');
        $.ajax({
            type: "POST",
            url: "<?php echo url('index.php/home/Cart/orderstate'); ?>",
            data: "o_id="+oid,
            dataType:'json',
            success: function(msg){
//                alert(msg);
                if(msg.az==2){
                    alert('确认收货成功');
                    $('.n'+oid).hide();
                    $('.huo').html('已确认收货');
                }
                if(msg.az==1){
                    alert('确认收货失败');
                }
            }
        });
    })
    //物流查询
    $('.wu').click(function(){
        var o_id=$(this).attr('alt');//订单id
        window.location.href="<?php echo url('index.php/home/Cart/logistics'); ?>?oid="+o_id;
    })
</script>