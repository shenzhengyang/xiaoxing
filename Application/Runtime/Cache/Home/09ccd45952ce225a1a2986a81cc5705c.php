<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1400px, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Public/Image/logo.png">

    <title>关于我们</title>

    <!-- Bootstrap core CSS -->
    <link href="../../Public/Css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../Public/Css/HomeCss/about.css" rel="stylesheet">
    <!-- Custom javascript for this template -->
    <script src="../../Public/Js/HomeJs/about.js"></script>
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
                <li class="dropdown">
                    <a href="<?php echo U('index');?>" class="dropdown-toggle" data-toggle="dropdown">数据分析 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo U('Index/position');?>">Position</a></li>
                        <li><a href="<?php echo U('Index/equip');?>">Equip</a></li>
                        <li><a href="<?php echo U('Index/equipment');?>">Equipment</a></li>
                        <li><a href="<?php echo U('Index/rail');?>">Rail</a></li>
                    </ul>
                </li>
                <!--<li><a href="#about">数据分析</a></li>-->
                <li class="active"><a href="<?php echo U('Index/about');?>">关于我们</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<!-- Subhead
================================================== -->
<header class="jumbotron subhead">
    <div class="container">
        <h1>孝行--让老年痴呆不在孤单</h1>
        <p class="lead">孝心无价，行走天下，愿天下所有的老人不在孤单！</p>
    </div>
</header>

<div class="container context">

    <!-- Docs nav
    ================================================== -->
    <div class="row">
        <div class="col-md-3 ">
            <div id="toc" class="bc-sidebar">
                <ul class="nav">
                    <li class="toc-h2">
                        <a href="#toc0">关于我们</a>
                    </li>
                    <li class="toc-h2">
                        <a href="#toc1">创业历程</a>
                    </li>
                    <li class="toc-h2 toc-active">
                        <a href="#toc2">加入我们</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <article class="post page">
                <section class="post-content">
                    <h2 id="toc0">关于我们</h2>
                    <p>&nbsp &nbsp &nbsp &nbsp 我们是一群热血青年，为了共同的梦想而走到了一起，我们团队的队员热情 高涨，积极投入，为了孝行智能助手有更好的发展而共同努力。孝行智能助手团 队是一支复合型的队伍。目前团队共有 7 名成员，专业技能与知识相互补充，知 识背景覆盖了：财务管理、会计、材料工程、计算机软件工程、市场营销、电子 商务、工业设计等领域。每一位成员都具有较为深厚的专业技术基础，富于激情 并有非常好的团队合作意识。
                        一路走来，我团队或多或少的收获了一些认可，在 许多比赛中获得了不错的名次</p>
                    <h2 id="toc1">创业历程</h2>
                    <p >
                        <img src="../../Public/Image/licheng.png" alt="..." style="width: 100%">
                    </p>

                    <h2 id="toc2">加入我们</h2>
                    <p>孝行致力于关爱老年人，让阿尔茨海默症摆脱病痛的折磨，孝心无价，行走天下，愿天下老年人不在孤单。</p>
                    <p>如果你也热爱公益，有一颗创业的心，欢迎和我们联系，更欢迎你加入我们的团队！</p>
                    <p>
                        Mail: xiaoxing_TM@163.com</p>

                </section>
            </article>
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
<!--================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="../../Public/Js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../Public/Js/HomeJs/ie10-viewport-bug-workaround.js"></script>
</body>
</html>