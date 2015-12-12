
<?php
$this->assign("nav", true);
?>

                           <?php $this->Html->addCrumb('物件詳細',
                            "/EstateView/detail/" . $this->request->data['PreviewBook']['estate_id']); ?>
<?php $this->Html->addCrumb('内見予約',
                            "/PreviewBook/book/" . $this->request->data['PreviewBook']['estate_id']); ?>


<center>
    <?php
    echo $this->Form->create("PreviewBook", array('url' => '/'));
    echo $this->Form->end("トップ画面に戻る");

    ?>
</center>
