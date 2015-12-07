<?php $this->assign("nav", true) ?>
<?php echo $this->Html->css(array('estate_view/detail'), false, array('inline' => false)); ?>


<?php
/**
 * GoogleMaps API GeoCode API(V3) のURLを取得する
 * @param    string $query 検索キーワード
 * @return    string URL URL
*/
function getURL_GeoCodeAPI_V3($query) {
    return "http://maps.google.com/maps/api/geocode/xml?address=" . urlencode($query) . "&sensor=false";
}

/**
 * Google Geocoding API V3 を用いて住所・駅名の緯度・経度を求める
 * @param    string $query 検索キーワード
 * @param    array  $items 情報を格納する配列
 * @return    int ヒットした施設数
*/
function getPointsV3($query, &$items) {
    $url = getURL_GeoCodeAPI_V3($query);            //リクエストURL

        $res = simplexml_load_file($url);
        //レスポンス・チェック
        if (preg_match("/ok/i", $res->status) == 0)        return 0;
        //検索結果取りだし
        $items[1]['latitude']  = (double)$res->result->geometry->location->lat;
        $items[1]['longitude'] = (double)$res->result->geometry->location->lng;
    return 1;
}

/**
 * 世界測地系を日本測地系に変換する
 * @param    double $lat  緯度（世界測地系）
 * @param    double $long 経度（世界測地系）
 * @return    double array(緯度,経度)（日本測地系）
*/
function wgs84_tokyo($lat, $long) {
    $glat  = $lat  + $lat * 0.00010696  - $long * 0.000017467 - 0.0046020;
    $glong = $long + $lat * 0.000046047 + $long * 0.000083049 - 0.010041;
    return array($glat, $glong);
}

function makeCommonBody($lat, $lng, $errmsg) {
    $type_g = 'ROADMAP';
    if ($errmsg == '') {
        $msg =<<< EOD
            <div id="gmap" style="width:280px; height:210px;"></div>
            <script type="text/javascript">
            <!--
            google.maps.event.addDomListener(window, 'load', function() {
            var mapdiv = document.getElementById('gmap');
            var myOptions = {
        zoom: 16,
        center: new google.maps.LatLng({$lat}, {$lng}),
        mapTypeId: google.maps.MapTypeId.{$type_g},
        mapTypeControl: true,
        scaleControl: true,
            };
            var map = new google.maps.Map(mapdiv, myOptions);

            //地図情報を取得
            function getPointData() {
        var point = map.getCenter();
        document.getElementById("lng").value = point.lng();
        document.getElementById("lat").value = point.lat();
        document.getElementById("zm").value  = map.getZoom();

        var type_g = map.getMapTypeId();
        var types = {"roadmap":"地図", "satellite":"航空写真", "hybrid":"ハイブリッド", "terrain":"地形図" };
        for (key in types) {
                    if (key == type_g) {
                        document.getElementById("type").value = types[key];
                        break;
                    }
        }
                wgs84_tokyo();
            }
            google.maps.event.addListener(map, 'dragend', getPointData);
            google.maps.event.addListener(map, 'zoom_changed', getPointData);
            });
            -->
        </script>

EOD;
    } else {
        $msg =<<< EOD
            <div id="gmap" style="width:300px; height:300px; text-align:center;">
            <span style="color:red;">エラー</span>
            </div>

EOD;
    }
    return $msg;
}

$address = '';
$errmsg = '';
$items = array();

//$n = getPointsV3($_POST['query'], $items);
$n = getPointsV3($estate['Estate']['address'], $items);
    if ($n <= 0) {
        $errmsg = 'この住所では検索できません';
    } else {
        $lat = $items[1]['latitude'];
        $lng = $items[1]['longitude'];
    }
$HtmlBody = makeCommonBody($lat, $lng, $errmsg);
//var_dump($HtmlBody);
?>

<script>
    $(function() {
        $( "#opinion" ).tabs();
    });
</script>

<center>


    <div id="estate_contents">

        <center>
            <div id="estate_img">
                <center>物件画像</center>
                <?php echo $this->Html->image('../upload/estate_pictures/' . $estate["Estate"]["estate_id"] . '/' .  "original_" . $estate['EstatePicture'][0]['picture_file_name']   , array("alt" => $estate["Estate"]["name"]));?>
            </div>

            <div id="floor_img">
                <center>間取り図</center>
                <?php echo $this->Html->image('../upload/estates/' . $estate["Estate"]["estate_id"] . '/' . "original_" . $estate['Estate']['floor_plan_picture_file_name'] , array("alt" => $estate["Estate"]["name"]));?>
            </div>


        </center>




        <center>
            <div id="estate_info">
                <div id=base>
                    <table border="1" rules="all">
                        <center>基本情報</center>
                        <tr>
                            <td style="background:#ccccff">物件名</td>
                            <td><?php echo h($estate['Estate']['name']); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">住所</td>
                            <td><?php echo h($estate['Estate']['address']); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">家賃</td>
                            <td><?php echo h($estate['Estate']['rent']); ?>円</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">共益費</td>
                            <td><?php echo h($estate['Estate']['common_service_pay']); ?>円</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">敷金</td>
                            <td><?php echo h($estate['Estate']['deposit']); ?>円</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">礼金</td>
                            <td><?php echo h($estate['Estate']['key_money']); ?>円</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">駐車場</td>
                            <td><?php echo h($estate['Estate']['parking_fee']); ?>円</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">取引態様</td>
                            <td><?php echo h($estate['EstateTradingAspect']['name']); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">面積</td>
                            <td><?php echo h($estate['Estate']['area']); ?>m&sup2;</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">間取</td>
                            <td><?php echo h($estate['Estate']['floor_plan']); ?></td>
                        </tr>

                        <tr>
                            <td style="background:#ccccff">物件構造</td>
                            <td><?php echo h($estate['EstateStructure']['name']); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">窓の向き</td>
                            <td><?php echo h($estate['Estate']['window_direction']); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">契約期間</td>
                            <td><?php echo h($estate['Estate']['contract_period']); ?>年</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">階建</td>
                            <td><?php echo h($estate['Estate']['story']); ?>階建</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">テレビ</td>
                            <td><?php echo h($estate['EstateTvType']['name']); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">インターネット回線</td>
                            <td><?php echo h($estate['EstateInternetType']['name']); ?></td>
                        </tr>
                    </table>
                </div>


                

                <ul id="right">
                    <li>
                        <div id="distance">
                            <table  border="1" rules="all" style="width: 200px; height: 100px;;">
                                <center>主要施設までの距離</center>
                                <tr>
                                    <td>
                                        <!--                    ここに主要施設までの距離-->
                                        
                                        <?php echo nl2br($str_emfd); ?>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </li>
                    <li>
                        <div id="char">
                            <table  border="1" rules="all" style="width: 200px; height: 100px;;">
                                <center>特徴</center>
                                <tr>
                                    <td align="center">
                                        <?php echo nl2br($str_characteristic); ?>
                                        
                                        
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div id="room">
                            <table  border="1" rules="all" style="width: 200px; height: 100px;;">
                                <center>部屋の構成</center>
                                <tr>
                                    <td>
                                        <!--                    ここに部屋の構成-->
                                        
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </li>
                </ul>

            </div>

        </center>

        <center>

            <div id="opinion">
                <center>生の声</center>
                <ul>
                    <li><a href="#opinion_agent">不動産業者</a></li>
                    <li><a href="#opinion_owner">大家</a></li>
                    <li><a href="#opinion_resident">入居者</a></li>
                </ul>

                <div id="opinion_agent">
                    <?php echo nl2br($estate['Estate']['frank_opinion_agent']); ?>
                </div>

                <div id="opinion_owner">
                    <?php echo nl2br($estate['Estate']['frank_opinion_owner']); ?>
                </div>

                <div id="opinion_resident">
                    <?php echo nl2br($estate['Estate']['frank_opinion_resident']); ?>
                </div>
            </div>


            <div id="map">
                <center>地図</center>
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.3&amp;sensor=false"></script>

                <?php echo $HtmlBody; ?>
            </div>
        </center>
        <?php echo $this->Html->link('内見予約画面へ', array('controller' => 'previewbook', 'action' => 'book', $estate['Estate']['estate_id'])); ?>
    </div>
</center>
