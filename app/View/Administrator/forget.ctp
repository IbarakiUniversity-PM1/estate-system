<h4>ログインしたい管理者のEメールアドレスを入力してください。</h4>
<?php
echo $this->Form->create(
	"Administrator",
	array(
		"url"=>
			array(
				"controller"=>"Administrator",
				"action"=>"complete"
			)
	)
);
echo $this->Form->input(
	"e_mail_address",
	array("label" => "Eメールアドレス")
);
echo $this->Html->div(
	"buttons",
	$this->Form->submit("送信")
);
$this->Form->end();
?>
