<?php $this->assign("nav", true) ?>
<?php echo $this->Html->css(array('estate_view/detail'), false, array('inline' => false)); ?>
<?php $this->Html->addCrumb('物件詳細' ,
                            "/EstateView/detail/" . $estate["Estate"]["estate_id"]); ?>

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

function makeCommonBody($lat, $lng, $errmsg) {
    $type_g = 'ROADMAP';
    if ($errmsg == '') {
        $msg =<<< EOD
            <div id="gmap" style="width:600px; height:300px;"></div>
            <script type="text/javascript">
            <!--
            rendererOptions = {
                draggable: true,
                preserveViewport:false
            };
            var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
            var directionsService = new google.maps.DirectionsService();
            var map;

            function initialize() {
                var zoom = 7;
                var mapTypeId = google.maps.MapTypeId.ROADMAP

                var opts = {
                    zoom: zoom,
                    mapTypeId: mapTypeId
                };
                map = new google.maps.Map(document.getElementById("gmap"),opts);
                directionsDisplay.setMap(map);

                google.maps.event.addListener(directionsDisplay, 'directions_changed', function(){});
                calcRoute();
            }

            function calcRoute() {
                var request = {
                origin: new google.maps.LatLng({$lat}, {$lng}),
                destination: new google.maps.LatLng(36.5727889, 140.6410467),
                travelMode: google.maps.DirectionsTravelMode.WALKING,
                unitSystem: google.maps.DirectionsUnitSystem.METRIC,
                optimizeWaypoints: true,
                avoidHighways: false,
                avoidTolls: false
            };

            directionsService.route(request, function(response,status){
                if (status == google.maps.DirectionsStatus.OK){
                    directionsDisplay.setDirections(response);
               }
              });
            }
            window.onload = initialize;

           //-->
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
            <div id="images">
                <div id="estate_img">
                    <center>物件画像</center>
                    <?php echo $this->Html->image('../upload/estate_pictures/' . $estate["Estate"]["estate_id"] . '/' .  "original_" . $estate['EstatePicture'][0]['picture_file_name']   , array("alt" => $estate["Estate"]["name"]));?>
                </div>

                <div id="floor_img">
                    <center>間取り図</center>
                    <?php echo $this->Html->image('../upload/estates/' . $estate["Estate"]["estate_id"] . '/' . "original_" . $estate['Estate']['floor_plan_picture_file_name'] , array("alt" => $estate["Estate"]["name"]));?>
                </div>
            </div>

        </center>
        <center>
            <div id="estate_info">
                <div id="base">
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
                            <td><?php echo h($estate['Estate']['rent'])."円"; ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">共益費</td>
                            <td><?php echo h($estate['Estate']['common_service_pay']."円"); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">敷金</td>
                            <td><?php echo h($estate['Estate']['deposit']."円"); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">礼金</td>
                            <td><?php echo h($estate['Estate']['key_money']."円"); ?></td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">駐車場</td>
                            <td>
                                <?php
                                    if($estate['Estate']['parking_flag'] === '1'){
                                        echo h($estate['Estate']['parking_fee']."円");
                                    }else{
                                        echo "なし";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">取引態様</td>
                            <td>
                                <?php 
                                    if(is_null($estate['EstateTradingAspect']['estate_trading_aspect_id'])){
                                        echo "-";
                                    }else{
                                        echo h($estate['EstateTradingAspect']['name']);
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">築年数</td>
                            <td>
                                <?php 
                                    $time_diff = time() - mb_strimwidth($estate['Estate']['age'], 0, 10);
                                    $age_year = date("Y", $time_diff) - 1970;
                     
                                    if($age_year < 1){
                                        echo "1年未満";   
                                    }else{
                                         echo h($age_year."年");
                                    }
                                ?>
                            </td> 
                        </tr>
                        <tr>
                            <td style="background:#ccccff">面積</td>
                            <td><?php echo h($estate['Estate']['area']); ?>畳</td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">間取</td>
                            <td><?php echo h($estate['Estate']['floor_plan']); ?></td>
                        </tr>

                        <tr>
                            <td style="background:#ccccff">物件構造</td>
                            <td>
                                <?php
                                    if(is_null($estate['EstateStructure']['estate_structure_id'])){
                                        echo "-";
                                    }else{
                                        echo h($estate['EstateStructure']['name']);
                                    }
                                ?>
                            </td>
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
                            <td>
                                <?php
                                    if(is_null($estate['EstateTvType']['estate_tv_type_id'])){
                                        echo "-";
                                    }else{
                                        echo h($estate['EstateTvType']['name']);
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#ccccff">インターネット回線</td>
                            <td>
                                <?php
                                    if(is_null($estate['EstateInternetType']['estate_internet_type_id'])){
                                        echo "-";
                                    }else{
                                        echo h($estate['EstateInternetType']['name']);
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="char">
                    <center>
                        <table  border="1" rules="all" >
                            特徴
                            <tr>
                                <td align="center">
                                    <?php echo nl2br($str_characteristic); ?>


                                </td>
                            </tr>
                        </table>
                    </center>
                </div>
<!--
                <div id="room">
                    <center>
                        <table  border="1" rules="all" >
                            部屋の構成
                            <tr>
                                <td>
                                                        ここに部屋の構成

                                </td>
                            </tr>
                        </table>
                    </center>
                </div>
-->
                <center>

                    <div id="distance">
                        <center>
                            <table  border="1" rules="all" >
                                主要施設までの距離
                                <tr>
                                    <td>
                                        <!--                    ここに主要施設までの距離-->

                                        <?php echo nl2br($str_emfd); ?>
                                    </td>
                                </tr>

                            </table>
                        </center>
                    </div>
                </center>
            </div>
        </center>
<center>
    <div id="map" title="地図">
        <center>地図</center>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.3&amp;sensor=false"></script>
        <?php echo $HtmlBody; ?>

    </div>
</center>
        <div class="tab-container">
            <!-- Codrops top bar -->

            <section class="tabs">
                <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
                <label for="tab-1" class="tab-label-1">不動産業者</label>

                <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
                <label for="tab-2" class="tab-label-2">大家</label>

                <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
                <label for="tab-3" class="tab-label-3">入居者</label>

                <div class="clear-shadow"></div>

                <div class="tab-content">
                    <div class="content-1">
                        <h2>生の声</h2>
                        <p><?php echo $efo_agent; ?></p>
                    </div>
                    <div class="content-2">
                        <h2>生の声</h2>
                        <p><?php echo $efo_owner; ?></p>
                    </div>
                    <div class="content-3">
<!--                        <h2>生の声</h2>-->
                        <?php echo $efo_resident; ?>
                    </div>
                </div>
            </section>
        </div>

        <?php
        $links="";
        if(isset($loginUser)){
            $links.=$this->Html->div(
                "",
                $this->Html->link("編集",
                    array(
                        "controller"=>"EstateManagement",
                        "action" => "edit",
                        $estate["Estate"]["estate_id"]
                    )
                )
            );
        }
        //非表示フラグが立っていないならば、内見予約画面へのリンクを追加
        if(!$estate["Estate"]["hide_flag"]){
            $links.=$this->Html->div(
                "",
                $this->Html->link(
                    '内見予約画面へ',
                    array(
                        'controller' => 'PreviewBook',
                        'action' => 'book',
                        $estate['Estate']['estate_id']
                    )
                )
            );
        }
        if(isset($loginUser)){
            $links.=$this->Html->div(
                "",
                $this->Form->postLink(
                    "削除",
                    array(
                        "controller"=>"EstateManagement",
                        "action" => "delete",
                        $estate["Estate"]["estate_id"]
                    ),
                    array("confirm" => "この物件を削除しても良いですか？\n※一度削除してしまうと、元に戻すことはできません！")
                )
            );
        }
        echo $this->Html->div(
            "buttons",
            $links
        );
        ?>


