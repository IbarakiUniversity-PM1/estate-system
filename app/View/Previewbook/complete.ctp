<center>
    <?php
    $this->assign("nav", true);
    echo $this->Form->create("Previewbook", array('url' => '/'));
    echo $this->Form->end("トップ画面に戻る");

    ?>
</center>
