<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=1400px, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="Public/Image/logo.png">

	<title>数据分析</title>

	<!-- Bootstrap core CSS -->
	<link href="../../Public/Css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="../../Public/Css/HomeCss/equip.css" rel="stylesheet">
	<!-- Custom javascript for this template -->
    <script src="../../Public/Js/jquery.js"></script>
    <script src="../../Public/Js/echarts.min.js"></script>
	<script src="../../Public/Js/HomeJs/equip.js"></script>
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

    <div class="container" id="">
		<div class="row">
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <div id="chart" style="width: 100%;height: 500px;" ></div>
				<table class="table table-hover" id="top2">
					<thead>
						<tr>
							<th>imei</th>
							<th>phone</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($equip)): $i = 0; $__LIST__ = $equip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$equip): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($equip['imei']); ?></td>
								<td><?php echo ($equip['phone']); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
            <div class="col-sm-2 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#chart">数据图表</a></li>
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

<script type="text/javascript">
    var count='<?php echo $count ?>'
    var json_count=$.parseJSON(count);
    var mychart=$("#chart");
    console.log(mychart);
    var zhu=echarts.init(document.getElementById('chart'));

    option = {
        color: ['#3398DB'],
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                data : [1,2,3,4,5,6,7,8],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'直接访问',
                type:'line',
                barWidth: '60%',
                data:json_count
            }
        ]
    };
    zhu.setOption(option);
</script>
	<!--================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="../../Public/Js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="../../Public/Js/HomeJs/ie10-viewport-bug-workaround.js"></script>
</body>
</html>