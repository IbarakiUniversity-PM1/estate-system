<h2>物件登録画面</h2>

<?php

echo $this->Form->create('Estate');
echo $this->Form->input('name', array('label' => '物件名'));
echo $this->Form->input('address', array('label' => '住所'));
echo $this->Form->input('estate_agent_id', array('label'=>'不動産業者名','type' => 'select', 'options' => array( $estateAgentList)));
echo $this->Form->input('rent', array('label' => '家賃(円)'));
echo $this->Form->input('key_money', array('label' => '礼金(円)'));
echo $this->Form->input('deposit', array('label' => '敷金(円)'));
echo $this->Form->input('common_service_pay', array('label' => '共益費(円)'));
echo $this->Form->input('floor_plain', array('label' => '間取り'));
echo $this->Form->input('story', array('label' => '階建'));
echo $this->Form->input('area', array('label' => '面積(m^2)'));
echo $this->Form->input('contract_period', array('label' => '契約期間(年)'));
echo $this->Form->input('parking_fee', array('label' => '駐車場料金(円)'));
echo $this->Form->input('estate_trading_aspect_id', array('label'=>'取引態様','type' => 'select', 'options' => array($estateTradingAspectList)));
echo $this->Form->input('estate_structure_id', array('label'=>'物件構造','type' => 'select', 'options' => array($estateStructureList)));
echo $this->Form->input('estate_type_id', array('label'=>'部屋種別','type' => 'select', 'options' => array($estateTypeList)));
echo $this->Form->input('estate_internet_type_id', array('label'=>'インターネット回線','type' => 'select', 'options' => array($estateInternetTypeList)));
echo $this->Form->input('estate_tv_type_id', array('label'=>'テレビ','type' => 'select', 'options' => array($estateTvTypeList)));
echo $this->Form->input('distance');

echo $this->Form->end('登録');

?>
