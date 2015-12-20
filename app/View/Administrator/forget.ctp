<h4>ログインしたい管理者のEメールアドレスを入力してください。</h4>
<?php
$this->Html->css("administrator/admin", array("inline" => false));
echo $this->Form->create("Administrator");
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
