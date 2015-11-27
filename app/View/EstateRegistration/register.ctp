<h2>物件登録画面</h2>

<?php

echo $this->Form->create('Estate', array('url' => array('controller' => 'estateregistration', 'action' => 'register'), 'enctype' => 'multipart/form-data'));
echo $this->Form->input('Estate.name', array('label' => '物件名'));
echo $this->Form->input('Estate.address', array('label' => '住所'));
echo $this->Form->input('Estate.estate_agent_id', array('label'=>'不動産業者名','type' => 'select', 'options' => array( $estateAgentList)));
echo $this->Form->input('Estate.rent', array('label' => '家賃(円)'));
echo $this->Form->input('Estate.key_money', array('label' => '礼金(円)'));
echo $this->Form->input('Estate.deposit', array('label' => '敷金(円)'));
echo $this->Form->input('Estate.common_service_pay', array('label' => '共益費(円)'));
echo $this->Form->input('Estate.floor_plan', array('label' => '間取り'));
echo $this->Form->input('Estate.story', array('label' => '階建'));
echo $this->Form->input('Estate.area', array('label' => '面積(m^2)'));
echo $this->Form->input('Estate.contract_period', array('label' => '契約期間(年)'));
echo $this->Form->input('Estate.parking_fee', array('label' => '駐車場料金(円)'));
echo $this->Form->input('Estate.estate_trading_aspect_id', array('label'=>'取引態様','type' => 'select', 'options' => array($estateTradingAspectList)));
echo $this->Form->input('Estate.estate_structure_id', array('label'=>'物件構造','type' => 'select', 'options' => array($estateStructureList)));
echo $this->Form->input('Estate.estate_type_id', array('label'=>'部屋種別','type' => 'select', 'options' => array($estateTypeList)));
echo $this->Form->input('Estate.estate_internet_type_id', array('label'=>'インターネット回線','type' => 'select', 'options' => array($estateInternetTypeList)));
echo $this->Form->input('Estate.estate_tv_type_id', array('label'=>'テレビ','type' => 'select', 'options' => array($estateTvTypeList)));


echo $this->Form->input('Estate.floor_plan_picture', array('type' => 'file', 'label' => '間取り図'));
echo $this->Form->input('EstatePicture.0.picture',array('type'=>'file','label'=>'画像'));

echo $this->Form->input('EstatePicture.0.thumbnail_flag');

echo $this->Form->end('登録');

?>
