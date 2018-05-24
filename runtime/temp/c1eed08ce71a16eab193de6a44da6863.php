<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"/www/wwwroot/crm.yuanhang.org/template/business/platform_total.html";i:1526822160;s:66:"/www/wwwroot/crm.yuanhang.org/template/business/public_header.html";i:1526259101;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 	
	<title>交易统计-POSCRM</title>
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
    <div class="notice"> 您当前的位置：<a href="<?php echo url('common/index'); ?>">首页</a> &gt; <a href="<?php echo url('platform/total'); ?>" class="v-link-active">交易统计</a> </div>
    <div class="main_content">
      <div class="title"> <span>高级搜索</span> </div>
      <form class="layui-form">
		<div class="layui-form-item">
		  <label class="layui-form-label">平台名称</label>
		  <div class="layui-input-inline">
			<select name="plat_name" lay-verify="required" lay-search="">
			  <option value="">请选择平台</option>
			  <?php if(is_array($plat_list_select) || $plat_list_select instanceof \think\Collection || $plat_list_select instanceof \think\Paginator): $i = 0; $__LIST__ = $plat_list_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			  <option value="<?php echo $vo['id']; ?>" <?php if($plat_name == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['plat_name']; ?></option>
			  <?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		  </div>
		</div>  	  
        <div class="layui-inline">
          <label class="layui-form-label">日期查询</label>
          <div class="layui-input-inline">
            <input type="text" class="layui-input" id="test1" name="create_time" placeholder="开始 到 结束" <?php if($create_time != ''): ?>value="<?php echo $create_time; ?>"<?php endif; ?>>
          </div>
        </div>           
        <button class="layui-btn" data-type="reload">查询</button> 
      </form>  
      <div class="title mt20"> <span>交易统计</span> </div>   
	  <a class="btn add-deal" href="javascript:;">添加</a>
	  <a class="btn" <?php if($plat_name == ''): ?>style="background-color:#0299bc;"<?php endif; ?> href="<?php echo url('platform/total'); ?>">全部</a>
	  <?php if(is_array($plat_list_select) || $plat_list_select instanceof \think\Collection || $plat_list_select instanceof \think\Paginator): $i = 0; $__LIST__ = $plat_list_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	  <a class="btn" href="<?php echo url('platform/total'); ?>?plat_name=<?php echo $vo['id']; ?>" <?php if($plat_name == $vo['id']): ?>style="background-color:#0299bc;"<?php endif; ?>><?php echo $vo['plat_name']; ?></a>
	  <?php endforeach; endif; else: echo "" ;endif; ?>	  
      <div class="table">
        <table>
          <thead>
            <tr>
              <th class="sort" width="80"><span>编号</span></th>
              <th class="sort" width="150"><span>平台名称</span></th>
              <th class="sort" width="100"><span>交易量</span></th>              
              <th class="sort" width="150"><span>交易日期</span></th>  
			  <?php if($user['position'] == 1): ?>
			  <th width="150"><span>操作</span></th>  
			  <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($trade_list) || $trade_list instanceof \think\Collection || $trade_list instanceof \think\Paginator): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><?php echo $vo['id']; ?></td>
              <td><?php echo $vo['plat_id']; ?></td>
              <td><?php echo $vo['money']; ?></td>
              <td><?php echo date("Y-m-d",$vo['create_time']); ?></td>
			  <td>
				<?php if($user['position'] == 1): ?>
				<a class="blue goedit" href="javascript:;" data-id="<?php echo $vo['id']; ?>">修改</a>
				<?php endif; ?>			  
			  </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <tr class="last_tr">
              <td>总计</td>
			  <td></td>
			  <td><?php echo $all_num; ?></td>
              <td></td>
            </tr>			
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
    </div>
  </div>
</div>
<div id="set-add-deal" style="display:none; width:550px; padding:20px;">
  <form class="layui-form" id="doAction"  method="post">
    <div class="layui-form-item">
      <label class="layui-form-label">平台名称</label>
      <div class="layui-input-inline">
        <select name="plat_id" lay-verify="required" lay-search="" id="plat_id">
		  <option value="">请选择平台</option>
          <?php if(is_array($plat_list_select) || $plat_list_select instanceof \think\Collection || $plat_list_select instanceof \think\Paginator): $i = 0; $__LIST__ = $plat_list_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['id']; ?>"><?php echo $vo['plat_name']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>  
    <div class="layui-form-item">
        <label class="layui-form-label">交易量</label>
        <div class="layui-input-inline">
          <input type="text" name="money" lay-verify="required" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">元</div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">交易日期</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" name="create_time" id="test9" placeholder="yyyy-MM-dd" value="<?php echo date('Y-m-d')?>">
      </div>
    </div>  
    <div><button class="layui-btn layui-btn ml80" lay-submit="" lay-filter="add"  data-href="<?php echo url('platform/total_add'); ?>">提交</button></div>
  </form>
</div>
<script>
//页面层
	$('.add-deal').on('click', function(){
		layer.open({
		  type: 1,
		  area: ['550px', '300px'],
		  shadeClose: true, //点击遮罩关闭
		  content: $('#set-add-deal')
		});
	}); 
  $('.goedit').on('click', function(){
	var id = $(this).data('id');
    layer.open({
      type: 2,
	  title: '编辑交易',
	  skin: 'layui-layer-rim', //加上边框
      area: ['800px', '300px'],
      content: '<?php echo url('platform/total_edit'); ?>?id='+id+''
    });
  });
</script> 
<script>
layui.use('form', function(){
  var form = layui.form;
          //监听提交
          form.on('submit(add)', function(data){
            var sub=true;
            var url=$(this).data('href');
            if(url){
                if(sub){
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: data.field,
                        success: function (info) {
                            if (info.code == 1) {
								layer.alert(info.msg,function(index){
									window.parent.location.reload();
									var index = parent.layer.getFrameIndex(window.name);
									parent.layer.close(index);
								});	
                            }
                            else {
                                common.layerAlertE(info.msg, '提示');
                                $(data.elem).removeAttr("disabled").text("提交");
                            }
                        },
                        beforeSend: function () {
                            $(data.elem).attr("disabled", "true").text("提交中...");
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            common.layerAlertE(textStatus, '提示');
                        }
                    });
                }
            }else{
                common.layerAlertE('链接错误！', '提示');
            }
            return false;
        });
  //各种基于事件的操作，下面会有进一步介绍
});
layui.use('laydate', function(){
  var laydate = layui.laydate;
  laydate.render({
    elem: '#test16'
    ,type: 'datetime'
    ,range: ','
    ,format: 'yyyy-M-d'
  });
  //年月选择器
  laydate.render({
    elem: '#test3'
    ,type: 'month'
  });  
 //日期时间选择器
  laydate.render({
    elem: '#test5'
    ,type: 'datetime'
  });  
  laydate.render({
    elem: '#test1'
    ,type: 'datetime'
    ,range: ','
    ,format: 'yyyy-M-d'
  });
  laydate.render({
    elem: '#test9'
  });  
});

//分页
function gopage(page){
  if(page == "no"){
    alert('您已在这一页');
    return false;
  }
  window.location.href="<?php echo url('platform/total'); ?>"+"?plat_name=<?php echo $plat_name; ?>&create_time=<?php echo $create_time; ?>&page="+page;
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