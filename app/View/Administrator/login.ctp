<?php
echo $this->Form->create();
echo $this->Form->input(
	"name",
	array("label" => "管理者ID")
);
echo $this->Form->input(
	"password",
	array("label" => "パスワード")
);
echo $this->Html->div(
	"buttons",
	$this->Form->submit("ログイン")
);
$this->Form->end();
?>
