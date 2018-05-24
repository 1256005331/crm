<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"/www/wwwroot/crm.yuanhang.org/template/business/sku_dolog.html";i:1527129208;s:66:"/www/wwwroot/crm.yuanhang.org/template/business/public_header.html";i:1526259101;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 	
	<title>日志-POSCRM</title>
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
    <div class="notice"> 您当前的位置：<a href="<?php echo url('common/index'); ?>">首页</a> &gt; <a href="<?php echo url('sku/dolog'); ?>" class="v-link-active">日志</a> </div>
    <div class="main_content">
      <div class="title"> <span>高级搜索</span> </div>
      <form class="layui-form">    
        <div class="layui-inline">
          <label class="layui-form-label">操作日期</label>
          <div class="layui-input-inline">
            <input type="text" name="log_time" class="layui-input" id="test16" placeholder="开始 到 结束" value="<?php echo $log_time; ?>">
          </div>
        </div>    
        <div class="layui-inline">
          <label class="layui-form-label">序列号</label>
          <div class="layui-input-inline">
            <input type="text" name="card_id" class="layui-input" placeholder="请输入序列号" value="<?php echo $card_id; ?>">
          </div>
        </div>   
        <button class="layui-btn" data-type="reload">搜索</button>         
      </form>
      <div class="title mt20"> <span>日志</span> </div>	  
      <div class="table">
        <table class="layuitable">
          <thead>
            <tr>
              <th class="sort" width="50"><span>编号</span></th>
              <th class="sort" width="100"><span>姓名</span></th>
              <th class="sort" width="100"><span>操作</span></th>
              <th class="sort" width="100"><span>操作内容</span></th>
              <th class="sort" width="100"><span>操作时间</span></th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($log_list) || $log_list instanceof \think\Collection || $log_list instanceof \think\Paginator): $i = 0; $__LIST__ = $log_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
              <td><?php echo $vo['id']; ?></td>
              <td><?php echo $vo['username']; ?></td>
              <td><?php echo $vo['active']; ?></td>
              <td><?php echo $vo['card_id']; ?></td>
              <td><?php echo date("Y-m-d H:i:s",$vo['log_time']); ?></td>
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
<script>
  $('.look_deail').on('click', function(){
	var id = $(this).data('id');
    layer.open({
      type: 2,
	  title: '操作内容',
	  skin: 'layui-layer-rim', //加上边框
      area: ['550px', '500px'],
      content: '<?php echo url('sku/log_content'); ?>?id='+id+''
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
});  
//分页
function gopage(page){
  console.log(page);
  if(page == "no"){
    alert('您已在这一页');
    return false;
  }
  window.location.href="<?php echo url('sku/dolog'); ?>"+"?card_id=<?php echo $card_id; ?>&log_time=<?php echo $log_time; ?>&page="+page;
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