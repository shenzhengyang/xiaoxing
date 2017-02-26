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
	<link href="../../Public/Css/HomeCss/rail.css" rel="stylesheet">
	<!-- Custom javascript for this template -->
	<script src="../../Public/Js/jquery.js"></script>
	<script src="../../Public/Js/echarts.min.js"></script>
	<script src="../../Public/Js/HomeJs/rail.js"></script>

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
            <div class="main" id="main"  style="width:100%;height: 400px;"></div>
			<table class="table table-hover" id="top2">
				<thead>
				<tr>
					<th>id</th>
					<th>eid</th>
					<th>lat</th>
					<th>lng</th>
					<th>radius</th>
				</tr>
				</thead>

				<tbody>

				<?php if(is_array($rail)): $i = 0; $__LIST__ = $rail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rail): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($rail['id']); ?></td>
						<td><?php echo ($rail['eid']); ?></td>
						<td><?php echo ($rail['lat']); ?></td>
						<td><?php echo ($rail['lng']); ?></td>
						<td><?php echo ($rail['radius']); ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>

        <div class="col-sm-2 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#main">数据图表</a></li>
                <li><a href="#top2">数据表格</a></li>
            </ul>
        </div>
	</div>

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

<script src="echarts.js"></script>
<script src="../../Public/Js/china.js"></script>
<script>
	var data='<?php echo $data ?>';
	var json_data=$.parseJSON(data);
    var chart = echarts.init(document.getElementById('main'));

	option = {
		title : {

		},
		tooltip : { text: '全国主要城市空气质量（pm2.5）',
			subtext: 'data from PM25.in',
			sublink: 'http://www.pm25.in',
			x:'center',
			trigger: 'item'
		},
		legend: {
			orient: 'vertical',
			x:'left',
			data:['坐标']
		},
		dataRange: {
			min : 0,
			max : 500,
			calculable : true,
			color: ['maroon','purple','red','orange','yellow','lightgreen']
		},
		toolbox: {
			show : true,
			orient : 'vertical',
			x: 'right',
			y: 'center',
			feature : {
				mark : {show: true},
				dataView : {show: true, readOnly: false},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
		series : [
			{
				name: '坐标',
				type: 'map',
				mapType: 'china',
				hoverable: false,
				roam: true,
				data: json_data,
				markPoint: {
					symbolSize: 5,       // 标注大小，半宽（半径）参数，当图形为方向或菱形则总宽度为symbolSize * 2
					itemStyle: {
						normal: {
							borderColor: '#87cefa',
							borderWidth: 1,            // 标注边线线宽，单位px，默认为1
							label: {
								show: false
							}
						},
						emphasis: {
							borderColor: '#1e90ff',
							borderWidth: 5,
							label: {
								show: false
							}
						}
					},
					data: [],

				}
			}
		]
	};
	chart.setOption(option);
//    $.get('map/json/china.json', function (chinaJson) {
//        echarts.registerMap('china', chinaJson);
//        var chart = echarts.init(document.getElementById('main'));
//        chart.setOption({
//            series: [{
//                type: 'map',
//                map: 'china'
//            }]
//        });
//    });
</script>
<script type="text/javascript">

    var data='<?php echo $data ?>';
    var json_data=$.parseJSON(data);
    option = {
        backgroundColor: new echarts.graphic.RadialGradient(0.3, 0.3, 0.8, [{
            offset: 0,
            color: '#f7f8fa'
        }, {
            offset: 1,
            color: '#cdd0d5'
        }]),
        xAxis: {
            type: 'value'
        },
        yAxis: {
            type: 'value'
        },
        dataZoom: [
            {   // 这个dataZoom组件，默认控制x轴。
                type: 'slider', // 这个 dataZoom 组件是 slider 型 dataZoom 组件
                start: 10,      // 左边在 10% 的位置。
                end: 60         // 右边在 60% 的位置。
            }
        ],
        series: [
            {
                type: 'scatter', // 这是个『散点图』
                itemStyle: {
                    normal: {
                        opacity: 0.8
                    }
                },
                symbolSize: function (val) {
                    return val[2] * 40;
                },
                data:json_data

            }
        ]
    }
    //var myChart = echarts.init(document.getElementById('main'));
    myChart.setOption(option);
</script>
<!--================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../../Public/Js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../Public/Js/HomeJs/ie10-viewport-bug-workaround.js"></script>
</body>
</html>