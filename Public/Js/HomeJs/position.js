/**
 * dataAnalysis界面脚本
 */
jQuery(function() {
    var lat,lng;
    var startPoint;
    var endPoint;
    var pointArray=new Array();
    var map = new BMap.Map("container");// 创建地图实例

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
                    addMarker(endPoint,"../../Public/Image/zhongdian48.svg","终点！");
                    addMarker(startPoint,"../../Public/Image/qidian48.svg","起点！");
                    createPolyline(data.points);
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
    }

    /**
     * 添加圆形覆盖物
     * @param point 中心点
     * @param radius 半径
     */
    function addCircle(point,radius){
        var circle = new BMap.Circle(point,radius,{strokeColor:"blue", strokeWeight:0.5, strokeOpacity:0.5});
        map.addOverlay(circle);
    }
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
});

