<?php $this->assign("nav", true) ?>
<?php echo $this->Html->css(array('estate_view/detail'), false, array('inline' => false)); ?>
<!--<?php debug($estate);?>-->


<div id="estate_contents">

    <div id="estate_img">
        <h4>物件画像</h4>
        <?php echo $this->Html->image('../upload/estate_pictures/' . $estate["Estate"]["estate_id"] . '/' . str_replace(".jpeg", "_original.jpeg", $estate['EstatePicture'][0]['picture_file_name'])   , array("alt" => $estate["Estate"]["name"]));?>
    </div>

    <div id="gmap">
        <h4>地図</h4>
    <!--    ここに地図を表示-->


    </div>

    <div id="floor_img">
        <h4>間取り図</h4>
        <?php echo $this->Html->image('../upload/estates/' . $estate["Estate"]["estate_id"] . '/' . str_replace(".jpeg", "_original.jpeg", $estate['Estate']['floor_plan_picture_file_name'])   , array("alt" => $estate["Estate"]["name"]));?>
    </div>



    <div id=base>
        <table border="1" rules="all">
          <caption>基本情報</caption>
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


  <?php
  $str_characteristic = "";
  if($estate['Estate']['bath_toilet']){
      $str_characteristic .= 'バストイレ:別'.PHP_EOL;
  }
  if($estate['Estate']['gas_stove']) {
      $str_characteristic .= 'ガスキッチン:あり'.PHP_EOL;
  }
  if($estate['Estate']['woman_only']) {
      $str_characteristic .= '女性限定'.PHP_EOL;
  }
  if($estate['Estate']['student_only']) {
      $str_characteristic .= '学生限定'.PHP_EOL;
  }
  if($estate['Estate']['room_share']) {
      $str_characteristic .= 'ルームシェア:可能'.PHP_EOL;
  }
  if($estate['Estate']['laundry_area']) {
      $str_characteristic .= '洗濯機置き場:室内'.PHP_EOL;
  }
  if($estate['Estate']['air_conditioner']) {
      $str_characteristic .= 'エアコン:あり'.PHP_EOL;
  }
  if($estate['Estate']['elevator']) {
      $str_characteristic .= 'エレベータ:あり'.PHP_EOL;
  }
  if($estate['Estate']['auto_lock']) {
      $str_characteristic .= 'オートロック:あり'.PHP_EOL;
  }
  if($estate['Estate']['interphone']) {
      $str_characteristic .= 'インターホン:あり'.PHP_EOL;
  }
  if($estate['Estate']['pet_breeding']) {
      $str_characteristic .= 'ペット飼育:可能'.PHP_EOL;
  }
  if($estate['Estate']['playing_an_instrument']) {
      $str_characteristic .= '楽器演奏:可能'.PHP_EOL;
  }

  ?>


    <div id="distance">
        <table  border="1" rules="all" style="width: 200px; height: 100px;;">
            <caption>主要施設までの距離</caption>
            <tr>
                <td>
<!--                    ここに主要施設までの距離-->
                </td>
            </tr>

        </table>
    </div>


    <div id="char">
      <table  border="1" rules="all" style="width: 200px; height: 100px;;">
        <caption>特徴</caption>
        <tr>
            <td align="center"><?php echo nl2br($str_characteristic); ?></td>
        </tr>
      </table>
    </div>


    <div id="room">
        <table  border="1" rules="all" style="width: 200px; height: 100px;;">
            <caption>部屋の構成</caption>
            <tr>
                <td>
                    <!--                    ここに部屋の構成-->
                </td>
            </tr>
        </table>
    </div>

    <div id="oinion_agent">
      <table border="1" rules="all" style="width: 200px; height: 100px;;">
        <caption>生の声(不動産業者)</caption>
        <tr>
            <td align="center"><?php echo nl2br($estate['Estate']['frank_opinion_agent']); ?></td>
        </tr>
      </table>
    </div>

    <div id="opinion_owner">
      <table border="1" rules="all" style="width: 200px; height: 100px;;">
        <caption>生の声(大家)</caption>
        <tr>
            <td align="center"><?php echo nl2br($estate['Estate']['frank_opinion_owner']); ?></td>
        </tr>
      </table>
    </div>

    <div id="opinion_resident">
      <table border="1" rules="all" style="width: 200px; height: 100px;;">
        <caption>生の声(入居者)</caption>
        <tr>
            <td align="center"><?php echo nl2br($estate['Estate']['frank_opinion_resident']); ?></td>
        </tr>
      </table>
    </div>

</div>


<?php echo $this->Html->link('内見予約画面へ', array('controller' => 'previewbook', 'action' => 'book', $estate['Estate']['estate_id'])); ?>

