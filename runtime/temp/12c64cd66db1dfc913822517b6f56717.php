<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"/www/wwwroot/crm.yuanhang.org/template/business/sku_out.html";i:1527125590;s:66:"/www/wwwroot/crm.yuanhang.org/template/business/public_header.html";i:1526259101;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 	
	<title>出库-POSCRM</title>
	<link rel="shortcut icon" href="//crm.yuanhang.org/public/static/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="//crm.yuanhang.org/public/static/css/font.css">
	<link rel="stylesheet" type="text/css" href="//crm.yuanhang.org/public/static/css/ui.css">
	<link rel="stylesheet" type="text/css" href="//crm.yuanhang.org/public/static/css/public.css">
	<link rel="stylesheet" type="text/css" href="//crm.yuanhang.org/public/static/layui/css/layui.css">
	<script type="text/javascript" src="//crm.yuanhang.org/public/static/js/jquery.min.js"></script>
	<script type="text/javascript" src="//crm.yuanhang.org/public/static/js/ui.js"></script>
	<script type="text/javascript" src="//crm.yuanhang.org/public/static/js/public.js"></script>
	<script type="text/javascript" src="//crm.yuanhang.org/public/static/layer/layer.js"></script>
	<script type="text/javascript" src="//crm.yuanhang.org/public/static/layui/layui.js"></script>
	<script type="text/javascript" src="//crm.yuanhang.org/public/static/js/global.js"></script>
</head>
<body>
	<div id="main-container">
		<div class="header">
			<div class="logo fl"><a href="javascript:;"><i class="icon icon-阿里云"></i></a></div>
			<div class="head_name fl"><a href="<?php echo url('common/index'); ?>">管理控制台</a></div>
			<div class="nav fl">
				<ul class="clearfix">
					<!--<li><a href="<?php echo url('activation/total'); ?>"><i class="icon icon-icon-menu-01"></i>激活统计</a></li>-->
					<li><a href="<?php echo url('platform/total'); ?>"><i class="icon icon-icon-menu-02"></i>交易统计</a></li>
					<li><a href="<?php echo url('sku/total'); ?>"><i class="icon icon-icon-menu-03"></i>库存统计</a></li>
				</ul>
			</div>
			<div class="head_tool fr">
				<a href="<?php echo url('common/index'); ?>"><i class="icon-首页"></i></a>
				<a href="<?php echo url('common/clear'); ?>"><i class="icon-更新"></i></a>
				<a href="<?php echo url('index/login_out'); ?>"><i class="icon-退出"></i></a>
			</div>
		</div>
		<div class="sidebar">
			<div class="sidebar_tool"><i class="icon-dedent"></i></div>
			<div class="nav_left">
				<ul>
					<?php if((in_array('Customer/index',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('customer/index'); ?>"><i class="icon-icon-child-1-1"></i><span>客户</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('customer/index'); ?>"><i class="icon-icon-child-1-1"></i><span>客户</span></a></li>
					<?php endif; if((in_array('Platform/index',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('platform/index'); ?>"><i class="icon-icon-child-1-2"></i><span>平台</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('platform/index'); ?>"><i class="icon-icon-child-1-2"></i><span>平台</span></a></li>
					<?php endif; if((in_array('Sku/put',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('sku/put'); ?>"><i class="icon-icon-child-1-3"></i><span>入库</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('sku/put'); ?>"><i class="icon-icon-child-1-3"></i><span>入库</span></a></li>
					<?php endif; if((in_array('Sku/out',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('sku/out'); ?>"><i class="icon-icon-child-1-4"></i><span>出库</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('sku/out'); ?>"><i class="icon-icon-child-1-4"></i><span>出库</span></a></li>
					<?php endif; if((in_array('Sku/quit',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('sku/quit'); ?>"><i class="icon-icon-child-1-5"></i><span>退库</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('sku/quit'); ?>"><i class="icon-icon-child-1-5"></i><span>退库</span></a></li>
					<?php endif; ?>
					<!--<?php if((in_array('Activation/index',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('activation/index'); ?>"><i class="icon-icon-child-1-6"></i><span>激活</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('activation/index'); ?>"><i class="icon-icon-child-1-6"></i><span>激活</span></a></li>
					<?php endif; ?>-->
					<?php if((in_array('Money/index',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('money/index'); ?>"><i class="icon-icon-child-1-7"></i><span>分红</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('money/index'); ?>"><i class="icon-icon-child-1-7"></i><span>分红</span></a></li>
					<?php endif; if((in_array('Service/index',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('service/index'); ?>"><i class="icon-icon-child-1-2"></i><span>维修</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('service/index'); ?>"><i class="icon-icon-child-1-2"></i><span>维修</span></a></li>
					<?php endif; if((in_array('Worker/index',$user['account_auth'])) and ($user['position'] != 1)): ?>
                    <li><a href="<?php echo url('worker/index'); ?>"><i class="icon-icon-child-1-1"></i><span>员工</span></a></li>
					<?php elseif($user['position'] == 1): ?>
					<li><a href="<?php echo url('worker/index'); ?>"><i class="icon-icon-child-1-1"></i><span>员工</span></a></li>
					<?php endif; if($user['position'] == 1): ?>
					<li><a href="<?php echo url('sku/dolog'); ?>"><i class="icon-icon-child-1-5"></i><span>日志</span></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
  <div class="main">
    <div class="notice"> 您当前的位置：<a href="<?php echo url('common/index'); ?>">首页</a> &gt; <a href="<?php echo url('sku/out'); ?>" class="v-link-active">出库</a> </div>
    <div class="main_content">
      <div class="title"> <span>高级搜索</span> </div>
      <form class="layui-form">
        <div class="layui-inline mr10">
          <div class="layui-input-inline">
            <select name="plat_name" lay-verify="required" lay-search="">
              <option value="">所属平台</option>              
              <?php if(is_array($plat_list_select) || $plat_list_select instanceof \think\Collection || $plat_list_select instanceof \think\Paginator): $i = 0; $__LIST__ = $plat_list_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>" <?php if($plat_id == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['plat_name']; ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </div>
        </div>
        <div class="layui-inline mr15">
          <div class="layui-input-inline">
            <select name="custom_id" lay-verify="required" lay-search="">
              <option value="">客户名称</option>              
              <?php if(is_array($customer_name_list) || $customer_name_list instanceof \think\Collection || $customer_name_list instanceof \think\Paginator): $i = 0; $__LIST__ = $customer_name_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>" <?php if($custom_id == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['customer_name']; ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </div>
        </div>       
        <div class="layui-inline">
          <label class="layui-form-label">序列号</label>
          <div class="layui-input-inline">
            <input type="text" name="card_id" placeholder="序列号" autocomplete="off" class="layui-input" value="<?php echo $card_id; ?>">
          </div>
        </div> 		
        <div class="layui-inline">
          <label class="layui-form-label">出货日期</label>
          <div class="layui-input-inline">
            <input type="text" name="out_time" class="layui-input" id="test16" placeholder="开始 到 结束" value="<?php echo $out_time; ?>">
          </div>
        </div>    
        <button class="layui-btn" data-type="reload">搜索</button>
      </form>
      <div class="kaohe mt20">
        <a class="layui-btn layui-btn-sm layui-btn-normal" href="?day=30">到期30天</a>
        <a class="layui-btn layui-btn-sm layui-btn-warm" href="?day=15">到期15天</a>
        <a class="layui-btn layui-btn-sm layui-btn-danger" href="?day=7">到期7天</a>
		<a class="layui-btn layui-btn-sm" href="?day=0">已到期</a>
      </div>
      <div class="title mt20"> <span>出库</span> </div>
	  <?php if((in_array('Sku/out_add',$user['account_auth'])) and ($user['position'] != 1)): ?>
      <a class="btn mr10" href="javascript:;" id="add-out">添加</a>
	  <?php elseif($user['position'] == 1): ?>
	  <a class="btn mr10" href="javascript:;" id="add-out">添加</a>
	  <?php endif; if((in_array('Sku/out_del',$user['account_auth'])) and ($user['position'] != 1)): ?>
	  <a class="btn do-action mr10" href="javascript:;" data-type="doDelete" data-href="<?php echo url('sku/out_del'); ?>">删除</a>	   
	  <?php elseif($user['position'] == 1): ?>
	  <a class="btn do-action mr10" href="javascript:;" data-type="doDelete" data-href="<?php echo url('sku/out_del'); ?>">删除</a>
	  <?php endif; ?>
	  <a class="btn" href="//crm.yuanhang.org/public/static/table_tpl.xlsx">导入模板下载</a>
	  <button type="button" class="btn" id="upload" style="float:right">
	     <i class="layui-icon">&#xe67c;</i>添加EXCEL表格数据
	  </button>
      <div class="table">
        <table class="layuitable">
          <thead>
            <tr>
              <th width="50"><input type="checkbox" name=""></th>
              <th class="sort" width="80"><span>编号</span></th>
              <th class="sort" width="100"><span>客户名称</span></th>
              <th class="sort" width="100"><span>平台名称</span></th>
              <th class="sort" width="100"><span>序列号</span></th>
              <th class="sort" width="80"><span>出货日期</span></th>
              <th class="sort" width="80"><span>考核日期</span></th>
              <th class="sort" width="80"><span>新旧程度</span></th>
              <th class="sort" width="80"><span>操作人</span></th>
              <th width="150"><span>操作</span></th>
            </tr>
          </thead>
          <tbody>
		  <?php if(is_array($out_list) || $out_list instanceof \think\Collection || $out_list instanceof \think\Paginator): $i = 0; $__LIST__ = $out_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><input type="checkbox" name="ck" ids="<?php echo $vo['id']; ?>" value="true"></td>
              <td><?php echo $vo['id']; ?></td>
              <td><?php echo $vo['custom_id']; ?></td>
              <td><?php echo $vo['plat_id']; ?></td>
              <td><?php echo $vo['card_id']; ?></td>
              <td><?php echo date("Y-m-d",$vo['out_time']); ?></td>
              <td><?php echo date("Y-m-d",$vo['check_time']); ?></td>
              <td><?php echo $vo['status']; ?></td>
              <td><?php echo $vo['out_operator']; ?></td>
              <td>
				<?php if((in_array('Sku/out_del',$user['account_auth'])) and ($user['position'] != 1)): ?>
				<a class="blue do-action" id="del" href="javascript:;" data-type="doDelOne" data-href="<?php echo url('sku/out_del'); ?>" data-id="<?php echo $vo['id']; ?>">删除</a>
				<?php elseif($user['position'] == 1): ?>
				<a class="blue do-action" id="del" href="javascript:;" data-type="doDelOne" data-href="<?php echo url('sku/out_del'); ?>" data-id="<?php echo $vo['id']; ?>">删除</a>
				<?php endif; ?>
			  </td>
            </tr>  
		  <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div>
      <div class="page fr">
          <div class="page_fonts">共有<?php echo $count; ?>条, 每页显示: 20条</div>
          <?php
            $fist_page = ($page == 1 ? 'no' : '1');
            $bottom_page = ($page == 1 ? 'no' : $page-1);
            echo("<a class=\"page_first\" href=\"javascript:gopage('".$fist_page."');\">&laquo;</a>");
            echo("<a class=\"page_prev\" href=\"javascript:gopage('".$bottom_page."');\">&lsaquo;</a>");
          ?>
          <div class="pages">
            <?php for($i = 1 ; $i <= ceil($count/20);$i++) {
              if($page == $i){
                echo("<a class=\"in\" href=\"javascript:gopage('no');\">$i</a>");
              }else{
                echo("<a href=\"javascript:gopage('".$i."');\">$i</a>");
              }
             } ?>
           </div>
           <?php
           $last_page = ($page == ceil($count/20) ? 'no' : ceil($count/20));
           $top_page = ($page == ceil($count/20) ? 'no' : $page+1);
           echo("<a class=\"page_first\" href=\"javascript:gopage('".$top_page."');\">&rsaquo;</a>");
           echo("<a class=\"page_prev\" href=\"javascript:gopage('".$last_page."');\">&raquo;</a>");
         ?> 
        </div>
      <div class="clear"></div>		 
    </div>
  </div>
</div>
<div id="set-add-out" style="display:none; width:550px; padding:20px;">
  <form class="layui-form" action="#" method="post" id="doAdd">
    <div class="layui-form-item">
      <label class="layui-form-label">客户名称</label>
      <div class="layui-input-inline">
        <select name="custom_id" lay-verify="required" lay-search="">
			<option value="">直接选择或搜索选择</option>
			<?php if(is_array($customer_name_list) || $customer_name_list instanceof \think\Collection || $customer_name_list instanceof \think\Paginator): $i = 0; $__LIST__ = $customer_name_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<option value="<?php echo $vo['id']; ?>"><?php echo $vo['customer_name']; ?></option>
			<?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <div class="layui-inline">
        <label class="layui-form-label">序列号</label>
        <div class="layui-input-inline" style="width: 100px;">
          <input type="text" name="card_id1" placeholder="起" autocomplete="off" class="layui-input" lay-verify="card_id1">
        </div>
        <div class="layui-form-mid">-</div>
        <div class="layui-input-inline" style="width: 100px;">
          <input type="text" name="card_id2" placeholder="止" autocomplete="off" class="layui-input" lay-verify="card_id2">
        </div>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">序列号</label>
      <div class="layui-input-inline">
        <input type="text" name="card_id" lay-verify="card_id" autocomplete="off" placeholder="请输入序列号" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">按单个填写</div>
    </div>       
    <div class="layui-form-item">
      <label class="layui-form-label">出货日期</label>
      <div class="layui-input-inline">
        <input type="text" name="out_time" class="layui-input" id="test1" placeholder="yyyy-MM-dd" lay-verify="required" value="<?php echo date('Y-m-d')?>">
      </div>
    </div>
    <div>
      <button class="layui-btn layui-btn ml80" lay-submit lay-filter="form">提交</button>
    </div>
  </form>
</div>
<script>
  //页面层
  $('#add-out').on('click', function(){
    layer.open({
      type: 1,
      area: ['550px', '350px'],
      shadeClose: true, //点击遮罩关闭
      content: $('#set-add-out')
    });
  });
layui.use(['form','upload'], function(){
	var form = layui.form;
	var upload = layui.upload;

  //文件上传
    var uploadInst = upload.render({
    elem: '#upload' //绑定元素
    ,url: "<?php echo url('Excel/read_excal'); ?>" //上传接口
    ,exts:'xlsx'
    ,field:'file'
    ,done: function(res){
      if(res.code == 1){
        layer.alert(res.msg, {icon: 6}, function(index){
	        window.location.href = "<?php echo url('sku/out'); ?>";
	      });
      }else{
        layer.alert(res.msg,{icon: 5});
      }
    }
    ,error: function(res){
      console.log(res);
      layer.alert('导入数据失败,请使用xlsx格式的表格进行导入操作。',{icon: 5});
      //请求异常回调
    }
  });


	var verify = function (obj) {
	    obj.addClass('layui-form-danger')
	        .focus()
	        .one('input',function () {
	            obj.removeClass('layui-form-danger').next('span').fadeOut();
	        })
	        .next('span').slideDown('fast');
	}
	form.on('submit(form)', function(data){
    layer.msg('添加中，请稍后..', {
      icon: 16
      ,shade: 0.01
      ,time:360000
    });
		$.ajax({
	        url:"<?php echo url('sku/out_add'); ?>",
			type:'POST',
	        data:$('#doAdd').serialize(),
	        dataType:"json",
	        error:function(data){
	            common.layerAlertE('链接错误！', '提示');
	        },
	        success:function(data){
            layer.close(layer.index);
	            if(data.code==1){
	                layer.alert(data.msg, {icon: 6}, function(index){
	                    layer.close(index);
	                    window.location.href = "<?php echo url('sku/out'); ?>";
	                });
	            }else{
	                layer.alert(data.msg, {icon: 5});
	                return false;
	            }
	        }
	    });
	    return false;
	});
});
layui.use('laydate', function(){
  var laydate = layui.laydate;
  laydate.render({
    elem: '#test16'
    ,type: 'datetime'
    ,range: ','
    ,format: 'yyyy-M-d'
  });
  laydate.render({
    elem: '#test1'
  }); 
  laydate.render({
    elem: '#test2'
  });  
}); 
//分页
function gopage(page){
  if(page == "no"){
    alert('您已在这一页');
    return false;
  }
  window.location.href="<?php echo url('sku/out'); ?>?plat_name=<?php echo $plat_id; ?>&order_num=<?php echo $order_num; ?>&card_id=<?php echo $card_id; ?>&out_time=<?php echo $out_time; ?>&page="+page;
}

//只显示相近的左右各五个分页按钮
$(function(){
  var page = "<?php echo($page);?>";
  if('<?php echo(ceil($count/20));?>' > 11){
    $('.pages>a').hide();
    $('.pages>a:eq('+(page-1)+')').show();
    for(var i = 1 ; i <= 5 ; i++){
      if(((page-1)-i) >= 0){
        $('.pages>a:eq('+((page-1)-i)+')').show();
      }
      if(((page-1)+i) <= '<?php echo(ceil($count/20));?>'){
        $('.pages>a:eq('+((page-1)+i)+')').show();
      }
    }
  }
}); 
</script>
</body>
</html>