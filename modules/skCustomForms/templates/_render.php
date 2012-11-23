<form action="<?php //echo url_for('@sk_custom_form?id='.$form->getFormObject()->id); ?>" method="post" enctype="application/x-www-form-urlencoded" name="sk_custom_form_<?php echo $form->getFormObject()->id?>" id="sk_custom_form_<?php echo $form->getFormObject()->id?>">
  <?php echo $form->renderHiddenFields()?>
    <fieldset>
        <legend><?php echo $form->getFormObject()->baslik?></legend><?php
            foreach($form as $field):
                if ( !stristr(get_class($field->getWidget()), 'hidden') ):?>
                    <div class="clearfix">
                        <?php echo $field->renderLabel()?>
                        <div class="input">
                            <?php echo $field->renderError() . $field->render()?>
                            <?php
                                if ( strlen($field->renderHelp()) ):
                                    echo content_tag('span', $field->getParent()->getWidget()->getHelp($field->getName()), array('class' => 'help-block'));
                                endif
                            ?>
                        </div>
                    </div><?php
                endif;
            endforeach
      ?><div class="actions">
          <input class="btn primary" value="<?php echo $form->getFormObject()->button_text?>" type="submit" id="form_submit_<?php echo $form->getFormObject()->id?>">
      </div>
  </fieldset>
</form>
