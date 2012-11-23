<?php use_stylesheet('/sfDoctrinePlugin/css/global.css', 'first') ?>
<?php use_stylesheet('/sfDoctrinePlugin/css/default.css', 'first') ?>
<div id="sf_admin_container">
    <h1>Form Members: <?php echo $custom_form?></h1>
    <div id="sf_admin_content">
        <?php include_partial('members', array('custom_form' => $custom_form, 'members' => $members, 'helper' => $helper))?>
    </div>
</div>