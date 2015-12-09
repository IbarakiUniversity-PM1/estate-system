<?php $this->Html->addCrumb('物件詳細',
                            "/EstateView/detail/" . $this->request->data['Previewbook']['estate_id']); ?>
<?php $this->Html->addCrumb('内見予約',
                            "/previewbook/book/" . $this->request->data['Previewbook']['estate_id']); ?>


<center>
    <?php
    $this->assign("nav", true);
    echo $this->Form->create("Previewbook", array('url' => '/'));
    echo $this->Form->end("トップ画面に戻る");

    ?>
</center>
