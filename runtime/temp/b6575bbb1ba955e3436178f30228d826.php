<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"/www/wwwroot/crm.yuanhang.org/template/business/money_index.html";i:1526003465;s:66:"/www/wwwroot/crm.yuanhang.org/template/business/public_header.html";i:1526259101;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 	
	<title>分红-POSCRM</title>
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
    <div class="notice"> 您当前的位置：<a href="<?php echo url('common/index'); ?>">首页</a> &gt; <a href="<?php echo url('money/index'); ?>" class="v-link-active">分红</a> </div>
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
          <div class="layui-input-inline">
            <select name="belong" lay-verify="required" lay-search="">
              <option value="">所属销售</option>
              <?php if(is_array($sale) || $sale instanceof \think\Collection || $sale instanceof \think\Paginator): $i = 0; $__LIST__ = $sale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>" <?php if($belong == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['realname']; ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </div>       
        <div class="layui-inline">
          <label class="layui-form-label">月份</label>
          <div class="layui-input-inline">
            <input type="text" name="months" class="layui-input" id="test16" placeholder="开始 到 结束" value="<?php echo $months; ?>">
          </div>
        </div>    
        <button class="layui-btn" data-type="reload">搜索</button>         
      </form>
      <div class="title mt20"> <span>分红</span> </div>
	  <?php if((in_array('Money/add',$user['account_auth'])) and ($user['position'] != 1)): ?>
      <a class="btn mr10" id="add-money" href="javascript:;">添加</a>
	  <?php elseif($user['position'] == 1): ?>
	  <a class="btn mr10" id="add-money" href="javascript:;">添加</a>
	  <?php endif; if((in_array('Money/del',$user['account_auth'])) and ($user['position'] != 1)): ?>
      <a class="btn do-action" href="javascript:;" data-type="doDelete" data-href="<?php echo url('money/del'); ?>">删除</a>	
	  <?php elseif($user['position'] == 1): ?>
	  <a class="btn do-action" href="javascript:;" data-type="doDelete" data-href="<?php echo url('money/del'); ?>">删除</a>	
	  <?php endif; ?>
      <div class="table">
         <table class="layuitable">
          <thead>
            <tr>
              <th width="50"><input type="checkbox" name=""></th>
              <th class="sort" width="80"><span>编号</span></th>
              <th class="sort" width="100"><span>平台名称</span></th>
              <th class="sort" width="100"><span>所属销售</span></th>
              <th class="sort" width="100"><span>提成比例</span></th>
              <th class="sort" width="100"><span>总分润金额</span></th>
              <th class="sort" width="100"><span>已下发代理分润金额</span></th>
              <th class="sort" width="100"><span>提成金额</span></th>
			  <th class="sort" width="100"><span>月份</span></th>
              <th width="80"><span>备注</span></th>
              <th width="150"><span>操作</span></th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($money_list) || $money_list instanceof \think\Collection || $money_list instanceof \think\Paginator): $i = 0; $__LIST__ = $money_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><input type="checkbox" name="ck" ids="<?php echo $vo['id']; ?>" value="true"></td>
              <td><?php echo $vo['id']; ?></td>
              <td><?php echo $vo['plat_id']; ?></td>
              <td><?php echo $vo['belong']; ?></td>
              <td><?php echo $vo['bonus']; ?>%</td>
              <td><?php echo $vo['total_money']; ?></td>              
              <td><?php echo $vo['down_money']; ?></td>
              <td><?php echo $vo['bonus_money']; ?></td>
              <td><?php echo date("Y-m",$vo['months']); ?></td>
              <td><?php echo $vo['remark']; ?></td>
              <td>
				<?php if((in_array('Money/edit',$user['account_auth'])) and ($user['position'] != 1)): ?>
				<a class="blue goedit" href="javascript:;" data-id="<?php echo $vo['id']; ?>">修改</a>
				<?php elseif($user['position'] == 1): ?>
				<a class="blue goedit" href="javascript:;" data-id="<?php echo $vo['id']; ?>">修改</a>
				<?php endif; if((in_array('Money/del',$user['account_auth'])) and ($user['position'] != 1)): ?>
				<a class="blue do-action" id="del" href="javascript:;" data-type="doDelOne" data-href="<?php echo url('money/del'); ?>" data-id="<?php echo $vo['id']; ?>">删除</a>
				<?php elseif($user['position'] == 1): ?>
				<a class="blue do-action" id="del" href="javascript:;" data-type="doDelOne" data-href="<?php echo url('money/del'); ?>" data-id="<?php echo $vo['id']; ?>">删除</a>
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
<div id="set-add-money" style="display:none; width:550px; padding:20px;">
	<form class="layui-form" action="#" method="post" id="doAdd">
    <div class="layui-form-item">
      <label class="layui-form-label">平台名称</label>
      <div class="layui-input-inline">
        <select name="plat_id" lay-verify="required" lay-search="">
          <option value="">直接选择或搜索选择</option>
          <?php if(is_array($plat_list_select) || $plat_list_select instanceof \think\Collection || $plat_list_select instanceof \think\Paginator): $i = 0; $__LIST__ = $plat_list_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['plat_name']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">所属销售</label>
      <div class="layui-input-inline">
        <select name="belong" lay-verify="required" lay-search="">
          <option value="">直接选择或搜索选择</option>
          <?php if(is_array($sale) || $sale instanceof \think\Collection || $sale instanceof \think\Paginator): $i = 0; $__LIST__ = $sale;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $vo['id']; ?>"><?php echo $vo['realname']; ?></option>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
      </div>
    </div>	
    <div class="layui-form-item">
      <label class="layui-form-label">提成比例</label>
      <div class="layui-input-inline">
        <input type="text" name="bonus" lay-verify="required" autocomplete="off" placeholder="请输入提成比例" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">总分润金额</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" name="total_money" placeholder="请输入总分润金额">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">已下发代理分润金额</label>
      <div class="layui-input-inline">
		<input type="text" class="layui-input" name="down_money" placeholder="请输入已下发代理分润金额">
      </div>
    </div>    
    <div class="layui-form-item">
      <label class="layui-form-label">提成金额</label>
      <div class="layui-input-inline">
        <input type="text" name="bonus_money" lay-verify="required" autocomplete="off" placeholder="请输入提成金额" class="layui-input">
      </div>
    </div> 
    <div class="layui-form-item">
      <label class="layui-form-label">月份</label>
      <div class="layui-input-inline">
		<input type="text" class="layui-input" id="test1" name="months" placeholder="yyyy-MM">      
      </div>
    </div> 	
    <div class="layui-form-item">
      <label class="layui-form-label">备注</label>
      <div class="layui-input-inline">
		<textarea placeholder="请输入备注" name="remark" lay-verify="remark" class="layui-textarea"></textarea>
      </div>
    </div> 
    <div>	
	<button class="layui-btn layui-btn ml80" lay-submit lay-filter="form">提交</button>
    </div>
  </form>
</div>
<script>
//页面层
  $('#add-money').on('click', function(){
    layer.open({
      type: 1,
      area: ['550px', '520px'],
      shadeClose: true, //点击遮罩关闭
      content: $('#set-add-money')
    });
  });
  $('.goedit').on('click', function(){
	var id = $(this).data('id');
    layer.open({
      type: 2,
	  title: '编辑激活',
	  skin: 'layui-layer-rim', //加上边框
      area: ['800px', '520px'],
      content: '<?php echo url('money/edit'); ?>?id='+id+''
    });
  });    
layui.use('form', function(){
	var form = layui.form;
	var verify = function (obj) {
	    obj.addClass('layui-form-danger')
	        .focus()
	        .one('input',function () {
	            obj.removeClass('layui-form-danger').next('span').fadeOut();
	        })
	        .next('span').slideDown('fast');
	}
	form.on('submit(form)', function(data){
		$.ajax({
	        url:"<?php echo url('money/add'); ?>",
			    type:'POST',
	        data:$('#doAdd').serialize(),
	        dataType:"json",
	        error:function(data){
	            common.layerAlertE('链接错误！', '提示');
	        },
	        success:function(data){
	            if(data.code==1){
	                layer.msg(data.msg, {icon: 6,time:1000}, function(index){
	                    layer.close(index);
	                    window.location.href = "<?php echo url('money/index'); ?>";
	                });
	            }else{
	                layer.msg(data.msg, {icon: 5,time:2000});
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
    ,type: 'month'
    ,range: ','
  });  
  laydate.render({
    elem: '#test1'
    ,type: 'month'
  }); 
}); 
//分页
function gopage(page){
  if(page == "no"){
    alert('您已在这一页');
    return false;
  }
  window.location.href="<?php echo url('money/index'); ?>?plat_name=<?php echo $plat_id; ?>&belong=<?php echo $belong; ?>&months=<?php echo $months; ?>&page="+page;
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