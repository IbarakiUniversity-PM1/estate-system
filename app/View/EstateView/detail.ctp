<?php $this->assign("nav", true) ?>
<?php echo $this->Html->css(array('detail'), false, array('inline'=>false)); ?>


<table border="1" rules="all" id="base">
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
    <td><?php echo h($estate['Estate']['area']); ?>m^2</td>
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
