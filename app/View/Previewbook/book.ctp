<?php
$this->assign("nav", true);?>
<?php echo $this->Html->css(array('preview/bbok'), false, array('inline' => false)); ?>

<div>
    <div>
<?php echo $estate['Estate']['name']; ?>
    </div>
    <?php
echo $this->Form->create('Previewbook', array('url' => array('controller' => 'Previewbook', 'action' => 'confirm')));
?>
<div id="vertical_middle">
<?php echo $this->Form->input('user_name', array('label' => '氏名', 'rows' => 1)); ?>
</div>
    <?php
echo $this->Form->input('email_address', array('label' => 'E-Mail', 'rows' => 1));
echo $this->Form->input('tel_number', array('label' => '電話番号', 'size' => 11));
echo $this->Form->input('preview_date_1', array('dateFormat' => 'YMD', 'maxYear' => date('Y'), 'minYear' => date('Y') - 100, 'monthNames' => false, 'label' => array('text' => '第一希望日')));
echo $this->Form->input('preview_date_2', array('dateFormat' => 'YMD', 'maxYear' => date('Y'), 'minYear' => date('Y') - 100, 'monthNames' => false, 'label' => array('text' => '第一希望日')));
echo $this->Form->input('preview_date_3', array('dateFormat' => 'YMD', 'maxYear' => date('Y'), 'minYear' => date('Y') - 100, 'monthNames' => false, 'label' => array('text' => '第一希望日')));
echo $this->Form->hidden('Previewbook.estate_id', array('value' => $estate['Estate']['estate_id']));
echo $this->Form->end('送信確認画面へ');
?>
    
</div>


