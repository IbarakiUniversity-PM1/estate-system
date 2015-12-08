<center>
<?php
$this->assign("nav", true);?>
<?php echo $this->Html->css(array('preview/bbok'), false, array('inline' => false)); ?>


    <div>

        <h4><?php echo $estate['Estate']['name']; ?>に内見予約のメールを送信します
        </h4>
        <?php
        echo $this->Form->create('Previewbook', array('url' => array('controller' => 'Previewbook', 'action' => 'confirm')));
        ?>
        <center>
            <ul style="list-style:none;">

                <li>
                    <div id="vertical_middle">
                        <?php echo $this->Form->input('user_name', array('label' => '氏名', 'rows' => 1)); ?>
                    </div>
                </li>


                <li>
                    <?php echo $this->Form->input('email_address', array('label' => 'E-Mail', 'rows' => 1)); ?>
                </li>


                <li>
                    <?php echo $this->Form->input('tel_number', array('label' => '電話番号', 'size' => 11));
                    ?>
                </li>


                <li>
                    <?php echo $this->Form->input('preview_date_1', array('dateFormat' => 'MD', 'maxYear' => date('Y'), 'minYear' => date('Y') - 100, 'monthNames' => false, 'label' => array('text' => '第一希望日')));
                    ?>
                </li>


                <li>
                    <?php echo $this->Form->input('preview_date_2', array('dateFormat' => 'MD', 'maxYear' => date('Y'), 'minYear' => date('Y') - 100, 'monthNames' => false, 'label' => array('text' => '第二希望日')));
                    ?>
                </li>


                <li>
                    <?php echo $this->Form->input('preview_date_3', array('dateFormat' => 'MD', 'maxYear' => date('Y'), 'minYear' => date('Y') - 100, 'monthNames' => false, 'label' => array('text' => '第三希望日')));
                    ?>
                </li>

                <li>
                    <?php echo $this->Form->hidden('Previewbook.estate_id', array('value' => $estate['Estate']['estate_id']));
                    ?>
                </li>

                <li>
                    <?php echo $this->Form->end('送信確認画面へ');
                    ?>
                </li>
            </ul>
        </center>

    </div>



</center>
