<center>
<?php
$this->assign("nav", true);
echo $this->Form->create('Previewbook', array('url' => array('controller' => 'Previewbook', 'action' => 'confirm')));
?>
    <?php $this->Html->addCrumb('物件詳細',
                                "/EstateView/detail/" . $this->request->data['Previewbook']['estate_id']); ?>
    <?php $this->Html->addCrumb('内見予約',
                                "/previewbook/book/" . $this->request->data['Previewbook']['estate_id']); ?>



    <div id="book_info">
        氏名:<?php echo $this->Form->value('user_name', array('label' => '氏名')) . PHP_EOL; ?><br>
        E-Mail:<?php echo $this->Form->value('email_address', array('label' => 'E-Mail')) . PHP_EOL; ?><br>
        電話番号:<?php echo $this->Form->value('tel_number', array('label' => '電話番号')) . PHP_EOL; ?><br>
        第一希望日:<?php echo sprintf('%d月%d日',
                                 $this->request->data['Previewbook']['preview_date_2']['month'],
                                 $this->request->data['Previewbook']['preview_date_3']['day']);
        ?><br>
        第二希望日:<?php echo sprintf('%d月%d日',
                                 $this->request->data['Previewbook']['preview_date_2']['month'],
                                 $this->request->data['Previewbook']['preview_date_3']['day']);
        ?><br>
        第三希望日:<?php echo sprintf('%d月%d日',
                                 $this->request->data['Previewbook']['preview_date_2']['month'],
                                 $this->request->data['Previewbook']['preview_date_3']['day']);
        ?><br>


        <?php
        echo $this->Form->hidden('user_name', array('value' => $this->request->data['Previewbook']['user_name']));
        echo $this->Form->hidden('email_address', array('value' => $this->request->data['Previewbook']['email_address']));
        echo $this->Form->hidden('tel_number', array('value' => $this->request->data['Previewbook']['tel_number']));
        echo $this->Form->hidden('preview_date_1', array('value' => implode("\t", $this->request->data['Previewbook']['preview_date_1'])));
        echo $this->Form->hidden('preview_date_2', array('value' => implode("\t", $this->request->data['Previewbook']['preview_date_2'])));
        echo $this->Form->hidden('preview_date_3', array('value' => implode("\t", $this->request->data['Previewbook']['preview_date_3'])));
        echo $this->Form->hidden('Previewbook.estate_id', array('value' => $this->request->data['Previewbook']['estate_id']));

        echo $this->Form->submit('送信', array('name' => 'submit', 'label' => false));
        echo $this->Form->submit('戻る', array('name' => 'cancel', 'label' => false));
        echo $this->Form->end();
        ?>

    </div>
</center>


<style>
    #book_info {
        width: 300px;
        border-style: solid;
        border-color: gray;
        border-radius:10px;
        background: #fff;

    }
</style>
