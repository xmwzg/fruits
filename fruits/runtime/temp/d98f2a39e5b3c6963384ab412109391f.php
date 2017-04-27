<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"E:\phpStudy\WWW\fruits\fruits\public/../application/home\view\userinfo\goaddress.html";i:1493187589;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>收获地址专区</title>
    <base href="__PUBLIC__">
    <link rel="stylesheet" type="text/css" href="home/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="home/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="home/css/base1.css"/>
    <link rel="stylesheet" type="text/css" href="home/css/style.css"/>
      <script src="home/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
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
				<img src="home/images/left.png"/>
			</a>
		<h3>收获地址专区</h3>			
			<a class="text-top" >
			</a>
	</header>
	
	<div class="contaniner fixed-conta">
		<form class="change-address" id="save">
			<ul>
				<li>
					<label class="addd">收货人：</label>
					<input type="text" class="names" required="required"/>
				</li>
				<li>
					<label class="addd">手机号：</label>
					<input type="tel" class="tel" required="required"/>
				</li>
				<li>
					<label class="addd">所在地区：</label>
					<select class="name" name="address">
						<?php foreach ($prev as $k=>$v){?>
						<option value="<?= $v['area_id']?>" class="a"><?= $v['area_name']?></option>
						<?php }?>
					</select>
				</li>
			</ul>
			<!-- <ul>
				<li class="checkboxa">
					<input type="checkbox" id="check"/>
					<label class="check" for="check" onselectstart="return false"  >设置为默认地址</label>
				</li>
			</ul> -->		
			<!-- <input type="button" value="保存" class="save"/> -->
			<center><button class="save" style="height: 35px;width: 80px;border-radius: 16px;">保 存<tton></center>
		</form>
	</div>
	
	<script src="home/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(".checkboxa label").on('touchstart',function(){
			if($(this).hasClass('checkd')){
				$(".checkboxa label").removeClass("checkd");
			}else{
				$(".checkboxa label").addClass("checkd");
			}
		})
	</script>	

</body>
</html>

<script>
$(document).on("change",".name",function(){
		var id = $(this).val();
		var _this = $(this);
		$(this).nextAll().remove();
		$.ajax({
		   type: "POST",
		   url: "<?php echo url('home/Userinfo/ajaxs'); ?>",
		   data: "id="+id,
		   dataType:'json',
		   success: function(msg){
		     if(msg != ''){
		     	var str ="";
		     	str+='<select class="name" name="address">';
		     	str+='<option value="">请选择</option>';
		     	$.each(msg,function(k,v){
		     		str+="<option value="+v.area_id+">"+v.area_name+"</option>";
		     	})
		     	str+='</select>';
		     	_this.after(str);
		     }
		   }
		});
	})
	$(".save").click(function(){
		var ass = $('.name option:selected').text();
		var names = $(".names").val();
		var tel = $(".tel").val();		 
		var box = $('input[name="check"]:checked').val(); 
		// alert(ass);
		
		$.ajax({
		   type: "POST",
		   url: "<?php echo url('home/Userinfo/forms'); ?>",
		   data: {ass:ass,names:names,tel:tel},
		    success: function(msg){
		    	if(msg == 1){
		    		window.location.href="<?php echo url('../../../home/userinfo/address'); ?>";
		    		
		    	}
		    }
		})

	})
</script>	