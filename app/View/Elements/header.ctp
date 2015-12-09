<div id="header_contents">
	<?php
	echo $this->Html->nestedList(array($this->element('breadcrumbs')),array("class"=>"site_header"));
	$list=array();
	if(isset($loginUser)){
		$list[]=$loginUser["name"]."さん";
	}
	$list[]=$this->Html->link(
		'ログイン',
		array(
			'controller'=>'Administrator',
			'action'=>'login'
		));
	echo $this->Html->nestedList($list,array("class"=>"user_menu"));
	?>
</div>
