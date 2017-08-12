/**
 * dataAnalysis界面脚本
 */
jQuery(function() {
    var lat,lng;
    var startPoint;
    var endPoint;
    var pointArray=new Array();
    var startPointMarker;
    var endPointMarker;
    var polylineMarker;
    var position_center_point;
    var map = new BMap.Map("container");// 创建地图实例
    //position 初始化数据
    $.post('Query_position_By_eid2',null,function(data,status){
        if(data==false){
            alert('数据初始化失败！该用户没有硬件设备！');
            location();
        }else{
            //json2array
            $.each(data,function(i,item){
                endPoint=new BMap.Point(item.lng,item.lat);
                pointArray[i]=endPoint;
            });
            //坐标批量转换
            var convertor = new BMap.Convertor();
            convertor.translate(pointArray, 1, 5, function(data){
                if(data.status === 0) {
                    startPoint=data.points[0];
                    endPoint=data.points[data.points.length-1];
                    lng=startPoint.lng;
                    lat=startPoint.lat;
                    map_init(lng,lat);//初始化
                    startPointMarker=addMarker(endPoint,"../../Public/Image/zhongdian48.svg","终点！");
                    endPointMarker=addMarker(startPoint,"../../Public/Image/qidian48.svg","起点！");
                    polylineMarker=createPolyline(data.points);
                }else{
                    alert("数据初始化失败！");
                }
            });
        }
    });

    /**
     * 地图初始化
     * @param id
     * @param lat
     * @param lng
     */
    function map_init(lat, lng) {
        var point = new BMap.Point(lat, lng);  // 创建点坐标
        position_center_point=point;
        map.enableScrollWheelZoom();
        var NavigationOpts = {offset: new BMap.Size(20, 100)}
        map.addControl(new BMap.NavigationControl(NavigationOpts));
        map.addControl(new BMap.ScaleControl());
        map.addControl(new BMap.OverviewMapControl());
        map.addControl(new BMap.MapTypeControl());
        var geolocationControl = new BMap.GeolocationControl();
        geolocationControl.addEventListener("locationSuccess", function(e){
            // 定位成功事件
            var address = '';
            address += e.addressComponent.province;
            address += e.addressComponent.city;
            address += e.addressComponent.district;
            address += e.addressComponent.street;
            address += e.addressComponent.streetNumber;
            alert("当前定位地址为：" + address);
        });
        geolocationControl.addEventListener("locationError",function(e){
            // 定位失败事件
            alert(e.message);
        });
        map.addControl(geolocationControl);
        map.centerAndZoom(point, 15);
    }

    /**
     *添加地图覆盖物Marker
     * @param point BMap.Point
     * @param path icon 路径
     * @param infowindow 消息窗口
     */
    function addMarker(point,path,content) {
        //创建自定义icon
        var myIcon = new BMap.Icon(path,new BMap.Size(48, 48), {offset: new BMap.Size(10, 25)});
        var marker = new BMap.Marker(point, {icon: myIcon});
        map.addOverlay(marker);
        marker.addEventListener("click", function(){
            createInfoWindow('提示',content,point)
        });
        marker.setAnimation(BMAP_ANIMATION_BOUNCE);
        return marker;
    }

    /**
     * 消息面板
     * @param titleContent 标题
     * @param content 内容
     */
    function createInfoWindow(titleContent, content,point) {
        var opts = {
            width: 100,     // 信息窗口宽度
            height: 40,     // 信息窗口高度
            title: titleContent  // 信息窗口标题
        }
        var infoWindow = new BMap.InfoWindow(content, opts);  // 创建信息窗口对象
        map.openInfoWindow(infoWindow, point);      // 打开信息窗口
    }

    /**
     * 生成polyline的icon箭头图标
     * @param weight 图标宽度
     * @returns {BMap.IconSequence} icon
     */
    function draw_line_direction(weight) {
        var icons=new BMap.IconSequence(
            new BMap.Symbol('M0 -5 L-5 -2 L0 -4 L5 -2 Z', {
                scale: weight/10,
                strokeWeight: 1,
                rotation: 0,
                fillColor: 'white',
                fillOpacity: 1,
                strokeColor:'white'
            }),'100%','5%',false);
        return icons;
    }
    /**
     * 添加折线覆盖物
     * @param PointArray BMap.Point 数组
     */
    function createPolyline(PointArray){
        var polyline = new BMap.Polyline(PointArray,
            {strokeColor:"blue", strokeWeight:6, strokeOpacity:0.5,icons:[draw_line_direction(6)]}
        );
        map.addOverlay(polyline);
        return polyline;
    }

    /**
     * 添加圆形覆盖物
     * @param point 中心点
     * @param radius 半径
     */
    function addCircle(point,radius){
        var circle = new BMap.Circle(point,radius,{strokeColor:"blue", strokeWeight:0.5, strokeOpacity:0.5});
        map.addOverlay(circle);
        return circle;
    }

    /**
     * 定位函数
     */
    function location(){
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                map_init(r.point.lng,r.point.lat);
                var mk = new BMap.Marker(r.point);
                map.addOverlay(mk);
                
            }
            else {
                alert('定位失败！'+this.getStatus());
            }
        },{enableHighAccuracy: true})
        //关于状态码
        //BMAP_STATUS_SUCCESS	检索成功。对应数值“0”。
        //BMAP_STATUS_CITY_LIST	城市列表。对应数值“1”。
        //BMAP_STATUS_UNKNOWN_LOCATION	位置结果未知。对应数值“2”。
        //BMAP_STATUS_UNKNOWN_ROUTE	导航结果未知。对应数值“3”。
        //BMAP_STATUS_INVALID_KEY	非法密钥。对应数值“4”。
        //BMAP_STATUS_INVALID_REQUEST	非法请求。对应数值“5”。
        //BMAP_STATUS_PERMISSION_DENIED	没有权限。对应数值“6”。(自 1.1 新增)
        //BMAP_STATUS_SERVICE_UNAVAILABLE	服务不可用。对应数值“7”。(自 1.1 新增)
        //BMAP_STATUS_TIMEOUT	超时。对应数值“8”。(自 1.1 新增)
    }

    /**
     * 函数还没写好！！！
     * Gps坐标转化为百度坐标
     * @param PointArray GSP坐标点数组
     * @param type 1->5
     * @constructor
     */
    function GSP2BdL(PointArray,type){
        var PointArrays=new Array();
        var n;
        if(PointArray.length<=100){

        }else{
            n=PointArray.length%100==0?PointArray.length/100:PointArray.length/100+1;
            for(var i=0;i<n;i++){
                PointArrays=PointArray
            }
        }
    }
    $("#positionBt").bind('click',function(){
        rail_huakuai_hide();
        if($("#positionBt").text()!=$("#BtList").text()){
            $("#BtList").text($("#positionBt").text());
            position_marker_show();
            rail_marker_hide();
            map.centerAndZoom(position_center_point, 15);
        }
    });
    /**
     * 电子围栏脚本
     */

    //控制滑块滑动
    $( "#draggable" ).draggable({ axis: "x",containment: "parent" });

    var drag_width;
    var pro_width;
    var pro_blue_width;
    var drag_left;
    var rail_lng;
    var rail_lat;
    var rail_radius;
    var rail_eid;
    var rail_circle_marker;
    var rail_point_marker;
    var rail_center_position;
    /**
     * rail 初始化
     */
    rail_innit();
    $("#railBt").bind('click',function(){
        rail_huakuai_show();
        if($("#railBt").text()!=$("#BtList").text()){
            $("#BtList").text($("#railBt").text());
            position_marker_hide();
            rail_marker_show();
            map.centerAndZoom(rail_center_position, 15);
        }
    });

    function rail_innit(){
        $.post("Query_rail_By_eid",null,function(data,status){
            if(data==false){
                alert("数据加载失败！");
            }else{
                $.each(data,function(i,item){
                    rail_lng=item.lng;
                    rail_lat=item.lat;
                    rail_lat=-rail_lat;
                    rail_radius=item.radius*10000;
                    rail_eid=item.eid;
                    rail_center_position= new BMap.Point(rail_lng, rail_lat);
                    //初始化滑块
                    drag_width=$("#draggable").width()+30;//padding值30
                    pro_width=$("#progress").width()-60;
                    drag_left=pro_width*(rail_radius/1000);
                    pro_blue_width=drag_left+15;
                    $("#draggable").css({
                        'left':drag_left+'px'
                    });
                    $("#progress_blue").width(drag_left+15);
                    $("#draggable").text(Math.round(rail_radius)+'米');
                    //初始化rail_marker
                    rail_point_marker=addMarker(rail_center_position,"../../Public/Image/oldperson.svg","当前位置：经度 "+rail_center_position.lng+"，纬度 "+rail_center_position.lat);
                    rail_circle_marker=addCircle(rail_center_position,rail_radius);
                    //滑块隐藏
                    rail_huakuai_hide();
                    //隐藏railMarker
                    rail_marker_hide();
                });
            }
        });
    }
    /**
     * 暂时选用mousseup
     */
    $("#draggable").mouseout(function(){

    });
    /**
     * 滑块滑动响应函数
     */
    $("#draggable").mouseup(function(){
        drag_width=$("#draggable").width()+30;//padding值30
        pro_width=$("#progress").width()-60;
        drag_left=$("#draggable").css('left');
        drag_left=Number(drag_left.substr(0,drag_left.length-2));
        //改变进度条
        $("#progress_blue").width(drag_left);
        rail_radius=(drag_left/pro_width)*1000;
        //改变围栏半径
        map.removeOverlay(rail_circle_marker);
        rail_circle_marker=addCircle(rail_center_position,rail_radius);
        $("#draggable").text(Math.round(rail_radius)+'米');
        $.post("Add_rail",{eid:rail_eid,lat:-rail_lat,lng:rail_lng,radius:rail_radius/10000},function(data,status){
            if(data!=true){
                alert("电子围栏数据更新失败！");
            }
        });
    });
    /**
     * 滑块消失
     */
    function rail_huakuai_hide(){
        $("#progress").hide();
        $("#draggable").hide();
    }
    /**
     * 滑块展示
     */
    function rail_huakuai_show(){
        $("#progress").show();
        $("#draggable").show();
    }

    /**
     * positionMarker 隐藏
     */
    function position_marker_hide(){
        startPointMarker.hide();
        endPointMarker.hide();
        polylineMarker.hide();
    }
    /**
     * positionMarker 显示
     */
    function position_marker_show(){
        startPointMarker.show();
        endPointMarker.show();
        polylineMarker.show();
    }

    /**
     * railMarker 隐藏
     */
    function rail_marker_hide(){
        rail_circle_marker.hide();
        rail_point_marker.hide();
    }

    /**
     * railMarker 展示
     */
    function rail_marker_show(){
        rail_circle_marker.show();
        rail_point_marker.show();
    }
});