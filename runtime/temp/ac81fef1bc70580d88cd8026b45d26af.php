<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"/www/wwwroot/crm.yuanhang.org/template/business/common_index.html";i:1526286455;s:66:"/www/wwwroot/crm.yuanhang.org/template/business/public_header.html";i:1526259101;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 	
	<title>首页-POSCRM</title>
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
			<div class="notice"></div>
			<div class="main_content">
				<div class="ui_prompt">提示：尊敬的<?php echo $username; ?>（<?php echo $position; ?>），欢迎您的使用，您的上次登录时间为 <?php echo $last_time; ?>，登录IP为 <?php echo $ip; ?></div>
				<div class="clearfix">
					<div class="index_block index_block_info">
						<i class="icon-信息"></i>
						<div class="fr">
							<p>客户总数</p>
							<strong><?php echo $customer_num; ?></strong>
						</div>
					</div>
					<div class="index_block index_block_column">
						<i class="icon-栏目"></i>
						<div class="fr">
							<p>今日入库</p>
							<strong><?php echo $put_num; ?></strong>
						</div>
					</div>
					<div class="index_block index_block_admin">
						<i class="icon-管理员"></i>
						<div class="fr">
							<p>今日出库</p>
							<strong><?php echo $out_num; ?></strong>
						</div>
					</div>
					<div class="index_block index_block_visit">
						<i class="icon-统计"></i>
						<div class="fr">
							<p>今日退库</p>
							<strong><?php echo $quit_num; ?></strong>
						</div>
					</div>
				</div>
				<div class="index_box">
					<div class="index_box_tit">分红统计</div>
					<div class="index_box_content">
						<div class="index_highcharts"></div>
						<script type="text/javascript" src="//crm.yuanhang.org/public/static/js/highcharts.js"></script>
						<script type="text/javascript">
							var data = <?php echo $money_num; ?>;
							var today = new Date();
							today.setHours(8 - 24*(data.length-1));
							today.setMinutes(0);
							today.setSeconds(0);
							today.setMilliseconds(0);
							$('.index_highcharts').highcharts({
						        chart: {
						            type: 'areaspline'
						        },
						        title: {
						            text: ''
						        },
						        legend: {
						            layout: 'vertical',
						            align: 'left',
						            verticalAlign: 'top',
						            x: 150,
						            y: 100,
						            floating: true,
						            borderWidth: 1,
						            backgroundColor: '#FFFFFF'
						        },
						        xAxis: {
						            allowDecimals: false,
						            type: 'datetime',
						            dateTimeLabelFormats: {
						                day: '%b-%e'
						            },
						            labels:{
						            	maxStaggerLines :3
						            }
						        },
						        yAxis: {
						            allowDecimals: false,
						            //tickPixelInterval: 200,
						            labels:{
						            	maxStaggerLines :3
						            },
						            title: {
						                text: ''
						            }
						        },
						        tooltip: {
						            pointFormat: '访问量: {point.y}次'
						        },
						        credits: {
						            enabled: false //禁用版权信息
						        },
						        plotOptions: {
						            areaspline: {
						                fillOpacity: 0.5
						            }
						        },
						        series: [{
						            name: '',
						            showInLegend: false,
						            data: data,
						            pointStart: Date.parse(today),
						            pointInterval: 24 * 3600 * 1000
						        }]
						    });
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>