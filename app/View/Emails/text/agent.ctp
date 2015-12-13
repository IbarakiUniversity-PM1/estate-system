<?php echo $agent_name ?>様

お客様より、以下のような内見予約が届きました。

【氏名】
<?php echo $user_name ?>


【Eメールアドレス】
<?php echo $email_address ?>


【電話番号】
<?php echo $tel_number ?>


【物件名】
<?php echo $estate_name ?>


<?php
$kanji=array("一","二","三");
for($i=0;$i<3;$i++){ ?>
【第<?php echo $kanji[$i] ?>希望日】
<?php echo $preview_date[$i] ?>


<?php } ?>

つきましては、メールにて、お客様と連絡を取っていただければと思います。

こうがく不動産
