<center>
<?php
$this->assign("nav", true);
echo $this->Form->create('PreviewBook', array('url' => array('controller' => 'PreviewBook', 'action' => 'complete')));
?>
    <?php $this->Html->addCrumb('物件詳細',
                                "/EstateView/detail/" . $data['PreviewBook']['estate_id']); ?>
    <?php $this->Html->addCrumb('内見予約',
                                "/PreviewBook/book/" . $data['PreviewBook']['estate_id']); ?>



    <div id="book_info">
        氏名:<?php echo $data['PreviewBook']['user_name']; ?><br>
        E-Mail:<?php echo $data['PreviewBook']['email_address']; ?><br>
        電話番号:<?php echo $data['PreviewBook']['tel_number']; ?><br>
        第一希望日:<?php echo $data['PreviewBook']['preview_date_1'];?><br>
        第二希望日:<?php echo $data['PreviewBook']['preview_date_2'];?><br>
        第三希望日:<?php echo $data['PreviewBook']['preview_date_3'];?><br>


        <?php
        echo $this->Form->hidden('user_name', array('value' => $data['PreviewBook']['user_name']));
        echo $this->Form->hidden('email_address', array('value' => $data['PreviewBook']['email_address']));
        echo $this->Form->hidden('tel_number', array('value' => $data['PreviewBook']['tel_number']));
        echo $this->Form->hidden('preview_date_1', array('value' => $data['PreviewBook']['preview_date_1']));
        echo $this->Form->hidden('preview_date_2', array('value' => $data['PreviewBook']['preview_date_2']));
        echo $this->Form->hidden('preview_date_3', array('value' => $data['PreviewBook']['preview_date_3']));
        echo $this->Form->hidden('PreviewBook.estate_id', array('value' => $data['PreviewBook']['estate_id']));

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
