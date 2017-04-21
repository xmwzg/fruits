<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"E:\WAPM\WWW\chenyan\11\frit\fruits\public/../application/home\view\cart\index.html";i:1492686241;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>购物车</title>
    <base href="__PUBLIC__">
    <!--<link rel="stylesheet" type="text/css" href="css/loaders.min.css"/>-->
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
<body>
<header class="page-header">
    <h3>购物车</h3>
</header>

<div class="contaniner fixed-contb">
    <?php if(is_array($data) || $data instanceof \think\Collection): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
    <section class="shopcar" alt="<?php echo $v['f_id']; ?>">
        <div class="shopcar-checkbox">
            <label for="shopcar" onselectstart="return false"></label>
            <input type="checkbox" id="shopcar"/>
        </div>
        <figure><img src="<?php echo $v['f_img']; ?>"/></figure>
        <dl>
            <dt><?php echo $v['f_name']; ?></dt>
            <dd><?php echo $v['f_weight']; ?></dd>
            <!--<dd>尺寸：L</dd>-->
            <div class="add" >
                <span class="jian">-</span>
                <input type="text" value="<?php echo $v['f_num']; ?>" />
                <span class="jia">+</span>
            </div>
            <h3>￥<?php echo $v['m_price']; ?></h3>

            <small class="del" alt="<?php echo $v['f_id']; ?>"><img src="car/images/shopcar-icon01.png"/></small>
        </dl>
    </section>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <input type="hidden" value="<?php echo $data[0]['u_id']?>" class="uid">
    <div style="margin-bottom: 16%;"></div>

</div>
<script type="text/javascript">
    $(".shopcar-checkbox label").on('touchstart',function(){
        if($(this).hasClass('shopcar-checkd')){
            $(".shopcar-checkbox label").removeClass("shopcar-checkd")
        }else{
            $(".shopcar-checkbox label").addClass("shopcar-checkd")
        }
    })
</script>
<footer class="page-footer fixed-footer">
    <div class="shop-go">
        <b>合计：￥<?php echo $money; ?></b>
        <span><a href="buy.html">去结算（2）</a></span>
    </div>
    <ul>
        <li>
            <a href="index.html">
                <img src="car/images/footer001.png"/>
                <p>首页</p>
            </a>
        </li>
        <li>
            <a href="assort.html">
                <img src="car/images/footer002.png"/>
                <p>分类</p>
            </a>
        </li>
        <li class="active">
            <a href="<?php echo url('home/Cart/index'); ?>">
                <img src="car/images/footer03.png"/>
                <p>购物车</p>
            </a>
        </li>
        <li>
            <a href="self.html">
                <img src="car/images/footer004.png"/>
                <p>个人中心</p>
            </a>
        </li>
    </ul>
</footer>


</body>
</html>
<script src="js/jq.js"></script>
<script>
    //删除数据
    $('.del').click(function(){
        var fid=$(this).attr('alt');
        var uid=$('.uid').val();
        var _this=$(this);
        $.ajax({
            type: "POST",
            url: "<?php echo url('index.php/home/Cart/del'); ?>",
            data: "uid="+uid+"&fid="+fid,
            dataType:'json',
            success: function(msg){
//                alert(msg);
                if(msg==333){
                    _this.parent().parent().remove();
                }

            }
        });
    })
    //减少数据
    $('.jian').click(function(){
        var num=$(this).next().val();
        var a=parseInt(num)-1;
        var uid=$('.uid').val();//用户id
        var fid=$(this).parent().parent().parent().attr('alt');
        var _this=$(this);
        if(a>0){
            $.ajax({
                type: "POST",
                url: "<?php echo url('index.php/home/Cart/kushao'); ?>",
                data: "num="+num+"&fid="+fid+"&uid="+uid,
                success: function(msg){
                    if(msg==2){
                        _this.next().val(a);
                    }
                }
            });
        }else {
            _this.next().val(num);
            alert('不能再少了')
        }
    })
    $('.jia').click(function(){
        var num=$(this).prev().val();
        var uid=$('.uid').val();//用户id

        var _this=$(this);
        var fid=$(this).parent().parent().parent().attr('alt');
        var a=parseInt(num)+1;
//        alert(a);
        $.ajax({
            type: "POST",
            url: "<?php echo url('index.php/home/Cart/ku'); ?>",
            data: "num="+num+"&fid="+fid+"&uid="+uid,
            dataType:'json',
            success: function(msg){
                if(msg==2){

                    _this.prev().val(a);
                }else {
                    alert('库存没有更多了');

                }
            }
        });
    })
</script>
