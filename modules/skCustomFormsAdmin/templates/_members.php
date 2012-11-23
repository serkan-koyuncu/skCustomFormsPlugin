<?php ?>
<div class="sf_admin_list">
      <table cellspacing="0">
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions">Position</th>
          <th class="sf_admin_text sf_admin_list_th_title">Member</th>
          <th class="sf_admin_date sf_admin_list_th_type">Type</th>
          <th id="sf_admin_list_th_actions">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="4"><?php echo __('')?></th>
        </tr>
      </tfoot>
      <tbody>
      <?php
      if ( count($members) ):
        foreach($members as $m):?>
        <tr class="sf_admin_row odd">
          <td>
            <?php echo $m->position?>
          </td>
          <td class="sf_admin_text sf_admin_list_td_title"><?php echo (string)$m?></td>
          <td class="sf_admin_date sf_admin_list_td_type"><?php echo skFormMemberTable::getMemberType($m->tip)?></td>
          <td>
              <ul class="sf_admin_td_actions">
                <?php echo $helper->LinkToPromote($custom_form, array('label' => __('Up')), $m)?>
                <?php echo $helper->LinkToDemote($custom_form, array('label' => __('Down')), $m)?>
                <?php echo $helper->LinkToMemberDelete($custom_form, array('label' => __('Delete'), 'confirm' => __('Are you sure?')), $m)?>
              </ul>
          </td>
          </tr>
        <?php endforeach?>
        <?php else:?>
        <tr>
            <td colspan="4"><?php echo __('No members found. Edit form and add some members.')?></td>
        </tr>
        <?php endif?>
        </tbody>
    </table>
  </div>

  <ul class="sf_admin_actions">
      <?php $formlar = skFormTable::getAllExcept($custom_form)?>
      <?php if ( count( $formlar ) ):?>
      <form method="post" action="<?php echo $helper->urlForMemberCopy($custom_form)?>" enctype="application/x-www-form-urlencoded">
          <span>Copy Member:</span>
          <select name="member_id" id="member_id"><?php
            foreach( $formlar as $form ):
                if ( count($form->FormMembers) ):
                    $opts = '';
                    foreach( $form->FormMembers as $member ):
                        $opts .= content_tag(
                                            'option',
                                            sprintf('%s (%s)', $member->title, skFormMemberTable::getMemberType($member->tip) ),
                                            array('value' => $member->id));
                    endforeach;
                    echo content_tag('optgroup', $opts, array('label' => $form->title));
                endif;
            endforeach;
          ?></select>
          <input type="submit" name="submit" value="<?php echo __('Add')?>" />
      </form>
      <br />
      <?php endif?>
      <?php echo $helper->linkToEdit($custom_form, array( 'params' => array( ),  'class_suffix' => 'edit',  'label' => __('Edit form and add new members') )) ?>
      <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => __('Back to list'),)) ?>
  </ul>
