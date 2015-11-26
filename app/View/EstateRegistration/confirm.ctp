<h2>入力内容をご確認ください</h2>
<?php

echo $this->Form->create('Estate', array('enctype' => 'multipart/form-data', 'action' => 'complete'));

echo $this->Form->value('name', array('label' => '物件名')).PHP_EOL;
echo $this->Form->hidden('name');

echo $this->Form->value('address', array('label' => '住所'));
echo $this->Form->hidden('address');

echo $this->Form->value('estate_agent_id', array('label'=>'不動産業者名'));
echo $this->Form->hidden('estate_agent_id');

echo $this->Form->value('rent', array('label' => '家賃(円)'));
echo $this->Form->hidden('rent');

echo $this->Form->value('key_money', array('label' => '礼金(円)'));
echo $this->Form->hidden('key_money');

echo $this->Form->value('deposit', array('label' => '敷金(円)'));
echo $this->Form->hidden('deposit');

echo $this->Form->value('common_service_pay', array('label' => '共益費(円)'));
echo $this->Form->hidden('common_service_pay');

echo $this->Form->value('floor_plan', array('label' => '間取り'));
echo $this->Form->hidden('floor_plan');

echo $this->Form->value('story', array('label' => '階建'));
echo $this->Form->hidden('story');

echo $this->Form->value('area', array('label' => '面積(m^2)'));
echo $this->Form->hidden('area');

echo $this->Form->value('contract_period', array('label' => '契約期間(年)'));
echo $this->Form->hidden('contract_period');

echo $this->Form->value('parking_fee', array('label' => '駐車場料金(円)'));
echo $this->Form->hidden('parking_fee');

echo $this->Form->value('estate_trading_aspect_id', array('label'=>'取引態様','type' => 'select', 'options' => array($estateTradingAspectList)));
echo $this->Form->hidden('estate_trading_aspect_id');

echo $this->Form->value('estate_structure_id', array('label'=>'物件構造','type' => 'select', 'options' => array($estateStructureList)));
echo $this->Form->hidden('estate_structure_id');

echo $this->Form->value('estate_type_id', array('label'=>'部屋種別','type' => 'select', 'options' => array($estateTypeList)));
echo $this->Form->hidden('estate_type_id');

echo $this->Form->value('estate_internet_type_id', array('label'=>'インターネット回線','type' => 'select', 'options' => array($estateInternetTypeList)));
echo $this->Form->hidden('estate_internet_type_id');

echo $this->Form->value('estate_tv_type_id', array('label'=>'テレビ','type' => 'select', 'options' => array($estateTvTypeList)));
echo $this->Form->hidden('estate_tv_type_id');

echo $this->Form->value('floor_plan_picture', array('type' => 'file', 'label' => '間取り図'));
echo $this->Form->hidden('floor_plan_picture');

echo $this->Form->value('EstatePicture.picture',array('type'=>'file','label'=>'画像'));
echo $this->Form->hidden('EstatePicture.picture');

echo $this->Form->end('登録');
