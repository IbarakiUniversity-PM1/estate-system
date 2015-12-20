<?php
$this->Html->css("administrator/admin", array("inline" => false));
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
); ?>
<h4><?php echo $this->Html->link(
    'パスワードを忘れた方',
    array('action' => 'forget')
) ?></h4>
<?php echo $this->Form->end() ?>
