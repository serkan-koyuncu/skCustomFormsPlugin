<?php

?>
<h3>Merhaba Yetkili;</h3>
<p>
    <b><?php echo date('d-m-Y H:i:s', time())?></b> tarihinde,
    <b><?php echo $form_data->ip?></b> IP adresinden,
    <b><?php echo $form->getFormObject()->id?></b> numaralı form (<?php echo $form->getFormObject()->title?>),
    <b><?php echo $sf_request->getReferer()?></b> sayfasından doldurularak sisteme kayıt edilmiştir.
</p>

<p>
    Yönetim panelinden incelemek için veri kimlik numarası: <b><?php echo $form_data->id?></b>
</p>


<table>
<caption>Form Bilgileri:</caption>
<?php foreach( $form as $widget ):?>
<tr>
    <th align="left"><?php echo $widget->renderLabel()?>:</th><td> <?php echo $widget->getValue()?></td>
</tr>
<?php endforeach?>
</table>

<p>--- mesaj sonu ---</p>
