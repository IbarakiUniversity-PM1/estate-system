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
echo $this->Form->input(
	"e_mail_address",
	array("label" => "Eメールアドレス")
);
echo $this->Html->div(
	"buttons",
	$this->Form->submit("登録")
);
$this->Form->end();
?>
