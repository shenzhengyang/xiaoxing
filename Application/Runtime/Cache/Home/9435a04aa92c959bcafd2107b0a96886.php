<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=1400px, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="Public/Image/favicon.ico">

	<title>数据分析</title>

	<!-- Bootstrap core CSS -->
	<link href="../../Public/Css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../../Public/Css/HomeCss/equipment.css" rel="stylesheet">
	<!-- Custom javascript for this template -->
	<script src="../../Public/Js/HomeJs/equipment.js"></script>
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="../../Public/Js/HomeJs/ie-emulation-modes-warning.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo U('../index');?>">孝行</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class=""><a href="<?php echo U('../index');?>">主页</a></li>
				<li class="dropdown active">
					<a href="<?php echo U('index');?>" class="dropdown-toggle" data-toggle="dropdown">数据分析 <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo U('Index/position');?>">Position</a></li>
						<li><a href="<?php echo U('Index/equip');?>">Equip</a></li>
						<li><a href="<?php echo U('Index/equipment');?>">Equipment</a></li>
						<li><a href="<?php echo U('Index/rail');?>">Rail</a></li>
					</ul>
				</li>
				<!--<li><a href="#about">数据分析</a></li>-->
				<li><a href="<?php echo U('Index/about');?>">关于我们</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>

<div class="container" id="top2">
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>id</th>
					<th>name</th>
					<th>uid</th>
					<th>eid</th>
				</tr>
				</thead>

				<tbody>
				<?php if(is_array($equipment)): $i = 0; $__LIST__ = $equipment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$equipment): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($equipment['id']); ?></td>
						<td><?php echo ($equipment['name']); ?></td>
						<td><?php echo ($equipment['uid']); ?></td>
						<td><?php echo ($equipment['eid']); ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
		</div>
		<div class="col-sm-2 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="active"><a href="#top1">数据图表</a></li>
				<li><a href="#top2">数据表格</a></li>
			</ul>
		</div>
	</div>
	<div style="height: 700px;"></div>
</div>
<!--footer-->
<footer class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<span>Copyright &copy; <a href="http://www.golaravel.com/">孝行团队</a></span> |
				<span>联系方式：<a href="http://www.miibeian.gov.cn/" target="_blank">xiaoxing_TM@163.com</a></span>
			</div>
		</div>
	</div>
</footer>
<!--================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../../Public/Js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../Public/Js/HomeJs/ie10-viewport-bug-workaround.js"></script>
</body>
</html>