<?php
echo $this->Html->nestedList(array($this->element('breadcrumbs')),array("class"=>"site_header"));
$list=array();
if(isset($loginUser)){
	$list[]="ログイン中 : ".$loginUser["name"];
	$list[]=$this->Html->link(
		'ログアウト',
		array(
			'controller'=>'Administrator',
			'action'=>'logout'
		));
}else{
	$list[]=$this->Html->link(
		'ログイン',
		array(
			'controller'=>'Administrator',
			'action'=>'login'
		));
}
echo $this->Html->nestedList($list,array("class"=>"user_menu"));
?>
